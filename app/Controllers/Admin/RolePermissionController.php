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
use Src\CSRFToken;
use Src\Controller;
use App\Models\Role;
use App\Models\User;
use Src\Session\Session;
use App\Models\DefaultRolePermission;
use App\Models\RolePermission;
use Src\View;

/**
 * 
 * @package GiGaCMS\Posts
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class RolePermissionController extends Controller
{

  /**
   * Create an instance of the Permission model class.
   * 
   * @access protected
   * @var RolePermission
   */
  protected RolePermission $permission;

  /**
   * Create an instance of the DefaultRolePermission model class.
   * 
   * @access protected
   * @var DefaultRolePermission
   */
  protected DefaultRolePermission $default_permission;

  /**
   * Create an instance of the Role model class.
   * 
   * @access protected
   * @var Role
   */
  protected Role $role;

  protected User $user;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->permission = new RolePermission('role_permissions');
    $this->default_permission = new DefaultRolePermission('default_role_permissions');
    $this->role = new Role('roles');
    $this->user = new User('users');
  }

  /**
   * Get data from a specific form.
   *
   * @access private
   * @return array
   */
  private function getPermission(): array
  {
    return [
      'content_write' => null !== $this->post('content_write') ? 1 : 0,
      'content_read' => null !== $this->post('content_read') ? 1 : 0,
      'content_update' => null !== $this->post('content_update') ? 1 : 0,
      'content_delete' => null !== $this->post('content_delete') ? 1 : 0,
      'content_global' => null !== $this->post('content_global') ? 1 : 0,
      'settings_write' => null !== $this->post('settings_write') ? 1 : 0,
      'settings_write_global' => null !== $this->post('settings_write_global') ? 1 : 0,
      'user_create' => null !== $this->post('user_create') ? 1 : 0,
      'user_read' => null !== $this->post('user_read') ? 1 : 0,
      'user_update' => null !== $this->post('user_update') ? 1 : 0,
      'user_delete' => null !== $this->post('user_delete') ? 1 : 0,
      'user_global' => null !== $this->post('user_global') ? 1 : 0,
    ];
  }

  /**
   * Display a listing of the roles available
   * show buttons to create a new roles and 
   * other buttons to edit or delete themselves.
   *
   * @return View
   */
  public function index(): View
  {
    return view('role-permissions/index', [
      'permissions' => $this->permission->findAll(),
      'roles' => $this->permission->role(),
      'index' => 1,
      'token' => CSRFToken::token()
    ]);
  }

  /**
   * Change permissions for a specific role.
   *
   * @return void
   * @throws Exception
   */
  public function create(): void
  {
    $this->permission->insert($this->getPermission());
    Session::setFlashMessage('FLASH_SUCCESS', 'Role created successfully');

    redirect('role-permissions');
  }

  /**
   * Modify the name of a specific role.
   *
   * @param integer $id
   * @return void
   * @throws Exception
   */
  public function change(int $id): void
  {
    $getRole = $this->permission->findById($id);
    $setRole = $this->role->findWhere('id', $getRole->role_id);

    $this->role->update($setRole->id, [
      'name_role' => ucfirst($this->post('alias_name_role')),
      'alias_name_role' => slug(strtolower($this->post('alias_name_role'))),
      'created_by' => Auth::id()
    ]);

    redirect('role-permissions');
  }

  /**
   * Change the permissions for a specific role.
   *
   * @param integer $id
   * @return void
   * @throws Exception
   */
  public function update(int $id): void
  {
    $this->permission->update($id, $this->getPermission());
    Session::setFlashMessage('FLASH_SUCCESS', 'Role updated successfully');

    redirect('role-permissions');
  }

  /**
   * Delete a specific role.
   *
   * @param integer $id
   * @return void
   *@throws Exception
   */
  public function delete(int $id): void
  {
    $getRole = $this->permission->findById($id);
    
    try {
      if (! $getRole) {
        throw new Exception('Role Not Found');
      }
      $this->role->delete($getRole->role_id);
      $this->permission->delete($id);

      redirect('role-permissions');
    } catch (Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }

  /**
   * Restore default roles and their permissions.
   * Delete roles added.
   *
   * @return View
   * @throws Exception
   */
  public function restoreDefaultPermission(): View
  {
    $default = $this->default_permission->findAll();
    $array_default = array();

    foreach ($default as $row) {
      $array_default[] = $row->role_id;
    }
    
    foreach ($this->role->findAll() as $role) {
      if (! in_array($role->id, $array_default)) {
        $this->role->delete($role->id);
      }
    }

    return view('role-permissions/index', [
      'permissions' => $this->default_permission->findAll(),
      'roles' => $this->permission->role(),
      'index' => 1,
      'token' => CSRFToken::token()
    ]);
  }
  
}