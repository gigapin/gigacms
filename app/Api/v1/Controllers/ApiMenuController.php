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

use App\Api\v1\Models\Response;
use App\Models\Menu;
use Src\Controller;

class ApiMenuController extends Controller
{
  /**
   * @var Menu
   */
  protected Menu $menu;

  /**
   * @var Response
   */
  protected Response $response;

  public function __construct()
  {
    $this->menu = new Menu('menus');  
    $this->response = new Response();
  }

  /**
   * @return void
   */
  public function index(): void
  {
    $this->response->setData([
      'menu' => $this->menu->findAll()
    ]);
    $this->response->send();
  }
}