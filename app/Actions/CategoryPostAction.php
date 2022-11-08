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

use Src\Http\Request;
use App\Models\CategoryPost;

/**
 * 
 * @package GiGaCMS\CategoryPost
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class CategoryPostAction
{
  /** 
   * @var object 
   * @access private
   */
  private object $categoryPost;

  /**
   * Constructor.
   */
  public function __construct()
  {
    $this->categoryPost = new CategoryPost('category_post');
  }

  /**
   * Storing relationship between category and post.
   *
   * @param object $postId
   * @return void
   */
  public function insertCategoryPost(object $postId): void
  {
    $this->categoryPost->insert([
      'category_id' => Request::post('category_id'),
      'post_id' => $postId->id
    ]);
  }

  /**
   * Update relationship between category and post.
   *
   * @param object $postId
   * @return void
   */
  public function updateCategoryPost(object $postId): void
  {
    $cats = [
      'category_id' => Request::post('category_id')
    ];
    $this->categoryPost->updateWhere('post_id', $postId->id, $cats);
  }

  /**
   * Call post method from CategoryPost model
   *
   * @param integer $id
   * @return mixed
   */
  public function getPost(int $id): mixed
  {
    return $this->categoryPost->post($id);
  }

  /**
   * Call category method from CategoryPost model.
   *
   * @return array
   */
  public function getCategory(): array
  {
    return $this->categoryPost->category();
  }
}