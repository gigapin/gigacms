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

namespace App\Actions;

use App\Models\Post;
use App\Models\Revision;
use Exception;

/**
 * @package GiGaCMS\Revisions
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class RevisionAction
{
  /**
   * Create an instance of the Revision model class.
   *
   * @var Revision
   */
  protected Revision $revision;

  /**
   * Create an instance of the Post model class.
   *
   * @var Post
   */
  protected Post $post;

  /**
   * Constructor.
   */
  public function __construct()
  {
    $this->revision = new Revision('revisions');
    $this->post = new Post('posts');
  }

  /**
   * Storing all changes of a specific post.
   *
   * @param array $data
   * @param integer $post_id
   * @return void
   * @throws Exception
   */
  public function store(array $data, int $post_id): void
  {
    $current = $this->revision->findLastOne('post_id', $post_id);

    if ($current) {
      $count = $current->revision_number + 1;
      if (str_word_count($data['post_content']) !== str_word_count($current->post_content)
        || $data['post_title'] !== $current->post_title) {
        $this->revision->insert([
          'post_id' => $post_id,
          'post_content' => $data['post_content'],
          'post_title' => $data['post_title'],
          'post_excerpt' => $data['post_excerpt'],
          'post_name' => $data['post_name'],
          'guid' => $data['guid'],
          'revision_number' => $count,
          'created_at' => setDate()
        ]);
      }
    } else {
      $this->revision->insert([
        'post_id' => $post_id,
        'post_content' => $data['post_content'],
        'post_title' => $data['post_title'],
        'post_excerpt' => $data['post_excerpt'],
        'post_name' => $data['post_name'],
        'guid' => $data['guid'],
        'revision_number' => 1,
        'created_at' => setDate()
      ]);
    }
  }

  /**
   * Get a specific version of a post.
   *
   * @param integer $id
   * @return mixed
   *@throws Exception
   */
  public function getRevision(int $id): mixed
  {
    try {
      if (! $this->revision->findById($id)) {
        throw new Exception('This version of this post not has been found');
      }

      return $this->revision->findById($id);
    } catch (Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }
}