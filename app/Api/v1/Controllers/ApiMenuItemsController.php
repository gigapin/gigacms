<?php 

namespace App\Api\v1\Controllers;

use App\Api\v1\Models\Response;
use App\Models\MenuItem;
use Src\Controller;

class ApiMenuItemsController extends Controller
{
  protected object $menu_items;
  protected object $response;

  public function __construct()
  {
    $this->menu_items = new MenuItem('menu_items');  
    $this->response = new Response();
  }

  public function index()
  {
    $this->response->setData([
      'menu_items' => $this->menu_items->findAll()
    ]);
    $this->response->send();
  }
}