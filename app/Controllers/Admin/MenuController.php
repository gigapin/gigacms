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

use Exception;
use Src\Auth;
use Src\Controller;
use App\Models\Menu;
use Src\Session\Session;
use Src\View;

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
   * @return View
   * @throws Exception
   */
  public function index(): View
  {
    return view('menus/index', [
      'menus' => $this->menu->findAllWhere('created_by', Auth::id()),
      'user' => $this->menu->user()
    ]);
  }

  /**
   * Display a form to create a new menu.
   *
   * @return View
   */
  public function create(): View
  {
    return view('menus/create');
  }

  /**
   * Storing a new menu.
   *
   * @return void
   * @throws Exception
   */
  public function store(): void
  {
    $this->menu->insert([
      'name' => $this->post('name'),
      'description' => $this->post('description') !== ''
        ? $this->post('description')
        : null,
      'created_by' => Auth::id(),
      'created_at' => setDate()
    ]);
    Session::setFlashMessage('FLASH_SUCCESS', 'Menu added successfully');
    
    redirect('menus');
  }

  /**
   * Display a form to edit a specific menu.
   *
   * @param integer $id
   * @return View
   * @throws Exception
   */
  public function edit(int $id): View
  {
    return view('menus/edit', [
      'menu' => $this->menu->findById($id)
    ]);
  }

  /**
   * Storing a menu updated.
   *
   * @param integer $id
   * @return void
   */
  public function update(int $id): void
  {
    try {
      if (! $this->menu->findById($id)) {
        throw new Exception('Resource Not Found');
      }
      $this->menu->update($id, [
        'name' => $this->post('name'),
        'description' => $this->post('description') !== '' ? $this->post('description') : null,
        'updated_at' => setDate() 
      ]);
      Session::setFlashMessage('FLASH_SUCCESS', 'Menu updated successfully');

      redirect('menus/edit/' . $id);
    } catch (Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }

  /**
   * Delete a specific menu.
   *
   * @param integer $id
   * @return void
   * @throws Exception
   */
  public function delete(int $id): void
  {
    $menu = $this->menu->findById($id);

    try {
      if (! $menu) {
        throw new Exception('Resource Not Found');
      }
      $this->menu->delete($id);

      redirect('menus');
    } catch (Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }
}