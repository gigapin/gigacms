<?php
/*
 * This file is part of the GiGaCMS package.
 *
 * (c) Giuseppe Galari <gigaprog@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Controllers\Admin;

use Src\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Revision;

/**
 * 
 * @package GiGaCMS\Revision
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class RevisionController extends Controller
{
  /**
   * Create an instance of the Revision class.
   *
   * @access protected
   * @var object
   */
  protected object $revision;

  /**
   * Create an instance of the User class.
   *
   * @access protected
   * @var object
   */
  protected object $user;

  /**
   * Create an instance of the Post class.
   *
   * @access protected
   * @var object
   */
  protected object $post;

  /**
   * Constructor.
   */
  public function __construct()
  {
    $this->revision = new Revision('revisions');  
    $this->user = new User('users');
    $this->post = new Post('posts');
  }

  /**
   * Display a listing of all versions of a specific post.
   *
   * @param integer $id
   * @return mixed
   */
  public function index(int $id): mixed
  {
    return view('revisions/index', [
      'revisions' => $this->revision->findAllWhere('post_id', $id)
    ]);
  }

  /**
   * Show a preview of a specific version of a post.
   *
   * @param integer $revision_id
   * @return mixed
   */
  public function preview(int $revision_id): mixed
  {
    return view('revisions/preview', [
      'revision' => $this->revision->findWhere('id', $revision_id),
      'user' => $this->user->findById($this->revision->user()->user_id) 
    ]);
  }

  /**
   * Remove an old version of a specific post.
   *
   * @param integer $id
   * @throws \Exception
   * @return mixed
   */
  public function delete(int $id): mixed
  {
    $post_id = $this->revision->findById($id)->post_id;
    try {
      if (! $this->revision->findById($id)) {
        throw new \Exception('Post Version Not Found');
      }
      $this->revision->delete($id);

      return redirect('revisions/' . $post_id);
    } catch (\Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }

}