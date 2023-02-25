<?php 

namespace App\Api\v1\Controllers;

use App\Api\v1\Models\Response;
use App\Models\MenuItem;
use App\Models\Setting;
use Src\Controller;

class ApiMenuItemsController extends Controller
{
  protected object $menu_items;
  protected object $response;
  protected object $settings;

  public function __construct()
  {
    $this->menu_items = new MenuItem('menu_items');  
    $this->response = new Response();
    $this->settings = new Setting('settings');
  }

  public function index()
  {
    $this->response->setSuccess(true);
    $this->response->setHttpStatusCode(200);
    $this->response->toCache(true);
    $this->response->addMessage('Posts displayed successfully');
    $this->response->setData([
      'menu_items' => $this->menu_items->findAll(),
      'site_name' => $this->getSiteName()
    ]);
    $this->response->send();
  }

  protected function getSiteName()
  {
    if ($this->settings->findWhere('option_name', 'site_name')->option_value !== null) {
      return $this->settings->findWhere('option_name', 'site_name')->option_value;
    } else {
      return 'GiGaCMS Website';
    }
  }
}