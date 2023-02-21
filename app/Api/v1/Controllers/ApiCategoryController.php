<?php 

namespace App\Api\v1\Controllers;

use App\Api\v1\Models\Response;
use App\Models\Category;
use Src\Controller;

class ApicategoryController extends Controller
{
  protected object $category;
  protected object $response;

  public function __construct()
  {
    $this->category = new Category('categories');
    $this->response = new Response();
  }

  public function index()
  {
    $this->response->setData([
      'categories' => $this->category->findAll()
    ]);
    $this->response->send();
  }
}