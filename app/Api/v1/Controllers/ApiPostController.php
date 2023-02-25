<?php 

namespace App\Api\v1\Controllers;

use Src\Controller;
use App\Models\Post;
use App\Models\Metadata;
use App\Api\v1\Models\Response;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Setting;

class ApiPostController extends Controller
{
  protected object $response;
  protected object $posts;
  protected object $metadata;
  protected object $menu_items;
  protected object $categories;
  protected object $settings;

  public function __construct()
  {
    $this->response = new Response();
    $this->posts = new Post('posts');  
    $this->metadata = new Metadata('metadata');
    $this->menu_items = new MenuItem('menu_items');
    $this->categories = new Category('categories');
    $this->settings = new Setting('settings');
  }

  public function index()
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

  public function blog() 
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

  protected function latestPosts()
  {
    if ($this->postStatus() !== false) {
      return $this->posts->findLatest('post_status', 'published', 5);
    }
  }

  protected function postStatus()
  {
    if ($this->settings->findWhere('option_name', 'post_status')->option_value === 'published') {
      return $this->posts->findAllWhere('post_status', 'published');
    }
    return false;
  }

  protected function showCategories()
  {
    if ($this->settings->findWhere('option_name', 'categories')->option_value !== null) {
      return $this->categories->findAll();
    }
    return false;
  }

  public function show(string $slug)
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