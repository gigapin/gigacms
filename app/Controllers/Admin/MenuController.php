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
use Src\Session\Session;

/**
 * @package GiGaCMS/Menu
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class MenuController extends Controller
{
  /**
   * Create an instance of the Menu class.
   * @access protected
   * @var object
   */
  protected object $menu;

  /**
   * Constructor.
   */
  public function __construct()
  {
    $this->menu = new Menu('menus');
  }

  /**
   * Display a listing of menus.
   *
   * @return mixed
   */
  public function index(): mixed
  {
    return view('menus/index', [
      'menus' => $this->menu->findAllWhere('created_by', Auth::id()),
      'user' => $this->menu->user()
    ]);
  }

  /**
   * Display a form to create a new menu.
   *
   * @return mixed
   */
  public function create(): mixed
  {
    return view('menus/create');
  }

  /**
   * Storing a new menu.
   *
   * @return mixed
   */
  public function store(): mixed
  {
    $this->menu->insert([
      'name' => $this->post('name'),
      'description' => $this->post('description') !== '' ? $this->post('description') : null,
      'created_by' => Auth::id(),
      'created_at' => setDate()
    ]);
    Session::setFlashMessage('FLASH_SUCCESS', 'Menu added successfully');
    
    return redirect('menus');
  }

  /**
   * Display a form to edit a specific menu.
   *
   * @param integer $id
   * @return mixed
   */
  public function edit(int $id): mixed
  {
    return view('menus/edit', [
      'menu' => $this->menu->findById($id)
    ]);
  }

  /**
   * Storing a menu updated.
   *
   * @param integer $id
   * @throws \Exception
   * @return mixed
   */
  public function update(int $id): mixed
  {
    try {
      if (! $this->menu->findById($id)) {
        throw new \Exception('Resource Not Found');
      }
      $this->menu->update($id, [
        'name' => $this->post('name'),
        'description' => $this->post('description') !== '' ? $this->post('description') : null,
        'updated_at' => setDate() 
      ]);
      Session::setFlashMessage('FLASH_SUCCESS', 'Menu updated successfully');

      return redirect('menus/edit/' . $id);
    } catch (\Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }

  /**
   * Delete a specific menu.
   *
   * @param integer $id
   * @throws \Exception
   * @return mixed
   */
  public function delete(int $id): mixed
  {
    $menu = $this->menu->findById($id);
    try {
      if (! $menu) {
        throw new \Exception('Resource Not Found');
      }
      $this->menu->delete($id);

      return redirect('menus');
    } catch (\Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }
}