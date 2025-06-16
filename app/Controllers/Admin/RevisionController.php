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

use Exception;
use Src\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Revision;
use Src\View;

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
   * @var Revision
   */
  protected Revision $revision;

  /**
   * Create an instance of the User class.
   *
   * @access protected
   * @var User
   */
  protected User $user;

  /**
   * Create an instance of the Post class.
   *
   * @access protected
   * @var Post
   */
  protected Post $post;

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
   * @return View
   * @throws Exception
   */
  public function index(int $id): View
  {
    return view('revisions/index', [
      'revisions' => $this->revision->findAllWhere('post_id', $id)
    ]);
  }

  /**
   * Show a preview of a specific version of a post.
   *
   * @param integer $revision_id
   * @return View
   * @throws Exception
   */
  public function preview(int $revision_id): View
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
   * @return void
   *@throws Exception
   */
  public function delete(int $id): void
  {
    $post_id = $this->revision->findById($id)->post_id;

    try {
      if (! $this->revision->findById($id)) {
        throw new Exception('Post Version Not Found');
      }
      $this->revision->delete($id);

      redirect('revisions/' . $post_id);
    } catch (Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }

}