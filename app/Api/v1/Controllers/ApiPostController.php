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
use App\Models\Metadata;
use App\Api\v1\Models\Response;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Setting;

class ApiPostController extends Controller
{
  /**
   * @var Response
   */
  protected Response $response;
  /**
   * @var Post
   */
  protected Post $posts;
  /**
   * @var Metadata
   */
  protected Metadata $metadata;
  /**
   * @var MenuItem
   */
  protected MenuItem $menu_items;
  /**
   * @var Category
   */
  protected Category $categories;
  /**
   * @var Setting
   */
  protected Setting $settings;

  public function __construct()
  {
    $this->response = new Response();
    $this->posts = new Post('posts');  
    $this->metadata = new Metadata('metadata');
    $this->menu_items = new MenuItem('menu_items');
    $this->categories = new Category('categories');
    $this->settings = new Setting('settings');
  }

  /**
   * @return void
   * @throws Exception
   */
  public function index(): void
  {
    $this->response->setSuccess(true);
    $this->response->setHttpStatusCode(200);
    $this->response->toCache(true);
    $this->response->addMessage('Posts displayed successfully');

    $this->response->setData([
      'posts' => $this->postStatus(),
      'menu_items' => $this->menu_items->findAll(),
      'metadata' => $this->metadata->findAll(),
      'categories' => $this->showCategories(),
      'username' => $this->posts->users()
    ]);
    
    $this->response->send();
  }

  /**
   * @return void
   * @throws Exception
   */
  public function blog(): void
  {
    $this->response->setSuccess(true);
    $this->response->setHttpStatusCode(200);
    $this->response->toCache(true);
    $this->response->addMessage('Posts displayed successfully');

    $this->response->setData([
      'posts' => $this->latestPosts(),
      'menu_items' => $this->menu_items->findAll(),
      'metadata' => $this->metadata->findAll(),
      'categories' => $this->showCategories(),
      'username' => $this->posts->users()
    ]);
    
    $this->response->send();
  }

  /**
   * @throws Exception
   */
  protected function latestPosts(): string|bool
  {
    if ($this->postStatus() !== false) {
      return $this->posts->findLatest('post_status', 'published', 5);
    }

    return false;
  }

  /**
   * @throws Exception
   */
  protected function postStatus(): string|bool
  {
    if ($this->settings->findWhere('option_name', 'post_status')->option_value === 'published') {
      return $this->posts->findAllWhere('post_status', 'published');
    }

    return false;
  }

  /**
   * @throws Exception
   */
  protected function showCategories(): string|bool
  {
    if ($this->settings->findWhere('option_name', 'categories')->option_value !== null) {
      return $this->categories->findAll();
    }

    return false;
  }

  /**
   * @throws Exception
   */
  public function show(string $slug): void
  {
    if ($this->posts->findWhereAnd('post_name', $slug, 'post_status', 'published')) {
      $this->response->setSuccess(true);
      $this->response->setHttpStatusCode(200);
      $this->response->toCache(true);
      $this->response->addMessage('Post displayed successfully');
      $post = $this->posts->findWhereAnd('post_name', $slug, 'post_status', 'published');
      $this->response->setData([
        'post' => $post,
        'menu_items' => $this->menu_items->findAll(),
        'metadata' => $this->metadata->findWhere('post_id', $post->id),
        'categories' => $this->showCategories(),
        'username' => $this->posts->user($post->id)
      ]);
    } else {
      $this->response->setSuccess(false);
      $this->response->setHttpStatusCode(404);
      $this->response->toCache(true);
      $this->response->addMessage('Post not found');
      
      $this->response->setData([
        'post' => null
      ]);
    }
    
    
    $this->response->send();
  }

}