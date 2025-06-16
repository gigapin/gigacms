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
use App\Models\MenuItem;
use App\Models\Setting;
use Exception;
use Src\Controller;

class ApiMenuItemsController extends Controller
{
  protected MenuItem $menu_items;
  protected Response $response;
  protected Setting $settings;

  public function __construct()
  {
    $this->menu_items = new MenuItem('menu_items');  
    $this->response = new Response();
    $this->settings = new Setting('settings');
  }

  /**
   * @throws Exception
   */
  public function index(): void
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

  /**
   * @throws Exception
   */
  protected function getSiteName(): string
  {
    if ($this->settings->findWhere('option_name', 'site_name')->option_value !== null) {
      return $this->settings->findWhere('option_name', 'site_name')->option_value;
    } else {
      return 'GiGaCMS Website';
    }
  }
}