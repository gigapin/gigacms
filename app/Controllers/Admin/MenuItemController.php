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

namespace App\Controllers\Admin;

use Src\Auth;
use Src\Controller;
use App\Models\Menu;
use App\Models\Post;
use App\Models\MenuItem;
use Src\Session\Session;

/**
 * @package GiGaCMS/Menu
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class MenuItemController extends Controller
{
  /**
   * Create an instance of MenuItem class.
   *
   * @access protected
   * @var object
   */
  protected object $menuItem;

  /**
   * Create an instance of Menu class.
   *
   * @access protected
   * @var object
   */
  protected object $menu;

  /**
   * Create an instance of Post class.
   *
   * @access protected
   * @var object
   */
  protected object $posts;

  /**
   * Constructor.
   */
  public function __construct() 
  {
    $this->menuItem = new MenuItem('menu_items');
    $this->posts = new Post('posts');
    $this->menu = new Menu('menus');
  }

  /**
   * Display a listing of items of the menus. 
   *
   * @return mixed
   */
  public function index(): mixed
  {
    return view('menu_items/index', [
      'menus' => $this->menuItem->findAllWhere('created_by', Auth::id())
    ]);
  }

  /**
   * Show a form to create new item for a menu.
   *
   * @return mixed
   */
  public function create(): mixed
  {
    $alert = count($this->menu->findAllWhere('created_by', Auth::id())) === 0 ? true : false;

    return view('menu_items/create', [
      'alert' => $alert,
      'posts' => $this->posts->findAllWhereAnd('user_id', Auth::id(), 'post_status', 'published'),
      'menus' => $this->menu->findAllWhere('created_by', Auth::id()),
      'status' => $this->status()->findAll(),
      'access' => $this->access()->findAll()
    ]);
  }

  /**
   * Storing menu items.
   *
   * @return mixed
   */
  public function store(): mixed
  {
    $this->menuItem->insert($this->getDataForm());
    Session::setFlashMessage('FLASH_SUCCESS', 'Menu Items added successfully');  

    return redirect('menu-items');
  }

  /**
   * Show a form of a specific menu item.
   *
   * @param integer $id
   * @return mixed
   */
  public function edit(int $id): mixed
  {
    return view('menu_items/edit', [
      'menuItem' => $this->menuItem->findById($id),
      'menus' => $this->menu->findAllWhere('created_by', Auth::id()),
      'posts' => $this->posts->findAllWhereAnd('user_id', Auth::id(), 'post_status', 'published'),
      'status' => $this->status()->findAll(),
      'access' => $this->access()->findAll()
    ]);
  }

  /**
   * Storing an menu item updated.
   *
   * @param integer $id
   * @return mixed
   */
  public function update(int $id): mixed
  {
    $this->menuItem->update($id, $this->getDataForm());
    Session::setFlashMessage('FLASH_SUCCESS', 'Menu Items updated successfully');  

    return redirect('menu-items/edit/' . $id);
  }

  /**
   * Delete a specific menu item.
   *
   * @param integer $id
   * @throws \Exception
   * @return mixed
   */
  public function delete(int $id): mixed
  {
    try {
      if (! $this->menuItem->findById($id)) {
        throw new \Exception('Resource Not Found');
      }
      $this->menuItem->delete($id);
      return redirect('menu-items');
    } catch (\Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }

  /**
   * Get menu item data from a form. 
   *
   * @return array
   */
  private function getDataForm(): array
  {
    return [
      'title' => $this->post('title'),
      'link' => $this->post('link'),
      'target_window' => $this->post('target_window') !== null ? $this->post('target_window') : 0,
      'menu_id' => $this->post('menu_id'),
      'parent_item' => $this->post('parent_item') !== '' ? $this->post('parent_item') : null,
      'default_page' => $this->post('default_page') !== null ? $this->post('default_page') : 0,
      'access' => $this->post('access'),
      'status' => $this->post('status'),
      'created_by' => Auth::id(),
      'updated_at' => setDate()
    ];
  }
}