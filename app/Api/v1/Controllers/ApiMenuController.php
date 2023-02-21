<?php 

namespace App\Api\v1\Controllers;

use App\Api\v1\Models\Response;
use App\Models\Menu;
use Src\Controller;

class ApiMenuController extends Controller
{
  protected object $menu;
  protected object $response;

  public function __construct()
  {
    $this->menu = new Menu('menus');  
    $this->response = new Response();
  }

  public function index()
  {
    $this->response->setData([
      'menu' => $this->menu->findAll()
    ]);
    $this->response->send();
  }
}