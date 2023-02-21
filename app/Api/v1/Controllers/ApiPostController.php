<?php 

namespace App\Api\v1\Controllers;

use Src\Controller;
use App\Models\Post;
use App\Models\Metadata;
use App\Api\v1\Models\Response;
use App\Models\Category;
use App\Models\MenuItem;

class ApiPostController extends Controller
{
  protected object $response;
  protected object $posts;
  protected object $metadata;
  protected object $menu_items;
  protected object $categories;

  public function __construct()
  {
    $this->response = new Response();
    $this->posts = new Post('posts');  
    $this->metadata = new Metadata('metadata');
    $this->menu_items = new MenuItem('menu_items');
    $this->categories = new Category('categories');
  }

  public function index()
  {
    $this->response->setSuccess(true);
    $this->response->setHttpStatusCode(200);
    $this->response->toCache(true);
    $this->response->addMessage('Posts displayed successfully');
    $this->response->setData([
      'posts' => $this->posts->findAll(),
      'menu_items' => $this->menu_items->findAll(),
      'metadata' => $this->metadata->findAll(),
      'categories' => $this->categories->findAll()
    ]);
    
    $this->response->send();
  }

}