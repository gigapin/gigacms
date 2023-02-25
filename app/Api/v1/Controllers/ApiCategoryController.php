<?php 

namespace App\Api\v1\Controllers;

use Src\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Api\v1\Models\Response;

class ApicategoryController extends Controller
{
  protected object $category;
  protected object $response;
  protected object $posts;
  protected object $category_post;

  public function __construct()
  {
    $this->category = new Category('categories');
    $this->response = new Response();
    $this->posts = new Post('posts');
    $this->category_post = new CategoryPost('category_post');
  }

  public function index()
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

  public function show(string $slug)
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

  protected function getPosts(string $slug)
  {
    $category = $this->category->findWhere('category_slug', $slug); 
    $posts = $this->category_post->findAllWhere('category_id', $category->id);
    foreach ($posts as $post) {
      $allPosts[] = $this->posts->findById($post->post_id);
    }
    return $allPosts;
  }
}