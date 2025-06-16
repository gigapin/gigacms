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

namespace App\Api\v1\Controllers;

use Exception;
use Src\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Api\v1\Models\Response;

class ApiCategoryController extends Controller
{
  /**
   * @var Category
   */
  protected Category $category;

  /**
   * @var Response
   */
  protected Response $response;

  /**
   * @var Post
   */
  protected Post $posts;

  /**
   * @var CategoryPost
   */
  protected CategoryPost $category_post;


  public function __construct()
  {
    $this->category = new Category('categories');
    $this->response = new Response();
    $this->posts = new Post('posts');
    $this->category_post = new CategoryPost('category_post');
  }

  /**
   * @return void
   */
  public function index(): void
  {
    $this->response->setSuccess(true);
    $this->response->setHttpStatusCode(200);
    $this->response->toCache(true);
    $this->response->addMessage('Posts displayed successfully');
    $this->response->setData([
      'categories' => $this->category->findAll()
    ]);
    $this->response->send();
  }

  /**
   * @throws Exception
   */
  public function show(string $slug): void
  {
    $this->response->setSuccess(true);
    $this->response->setHttpStatusCode(200);
    $this->response->toCache(true);
    $this->response->addMessage('Category displayed successfully');
    $this->response->setData([
      'categories' => $this->getPosts($slug),
      'username' => $this->posts->users()
    ]);
    $this->response->send();
  }

  /**
   * @throws Exception
   */
  protected function getPosts(string $slug): array
  {
    $allPosts = [];
    $category = $this->category->findWhere('category_slug', $slug); 
    $posts = $this->category_post->findAllWhere('category_id', $category->id);
    foreach ($posts as $post) {
      $allPosts[] = $this->posts->findById($post->post_id);
    }

    return $allPosts;
  }
}