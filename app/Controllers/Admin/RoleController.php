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
use App\Models\Role;
use Src\Http\Request;
use Src\Session\Session;
use App\Models\RolePermission;
use Src\Validation\ValidateRequest;

/**
 * 
 * @package GiGaCMS\Posts
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class RoleController extends Controller
{
  /**
   * Create an instance of the Role model class.
   *
   * @access protected
   * @var Role
   */
  protected Role $role;

  /**
   * Create an instance of the RolePermission model class.
   *
   * @access protected
   * @var RolePermissionController
   */
  protected RolePermission $permission;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->role = new Role('roles');
    $this->permission = new RolePermission('role_permissions');
  }

  /**
   * Set validation rules.
   *
   * @access private
   * @return array
   */
  private function setValidationRule(): array
  {
    return [
      'alias_name_role' => [
        'required' => true,
        'max' => 20,
        'string' => true,
        'unique' => [
          true,
          new Role('roles')
        ]
      ]
    ];
  }

  /**
   * Get data from the form.
   *
   * @access private
   * @return array
   * @throws Exception
   */
  private function getRole(): array
  {
    return [
      'name_role' => ucfirst($this->post('alias_name_role')),
      'alias_name_role' => slug(strtolower($this->post('alias_name_role'))),
      'created_by' => Auth::id()
    ];
  }

  /**
   * Setting records to storing into roles table.
   *
   * @access private
   * @param integer $id
   * @return array
   */
  private function setRole(int $id): array
  {
    return [
      'role_id' => $id,
      'content_write' => null,
      'content_read' => null,
      'content_update' => null,
      'content_delete' => null,
      'content_global' => null,
      'settings_write' => null,
      'settings_write_global' => null,
      'user_create' => null,
      'user_read' => null,
      'user_update' => null,
      'user_delete' => null,
      'user_global' => null,
    ];
  }

  /**
   * Storing role and role permission fromdata get from the specific form.
   *
   * @return void
   * @throws Exception
   */
  public function store(): void
  {
    if (! is_null(Request::validate($this->setValidationRule()))) {
      ValidateRequest::storingSession($this->setValidationRule(), 'role-permissions');
    }
    ValidateRequest::unsetSession();
    
    $this->role->insert($this->getRole());
    $role_added = $this->role->findWhere('alias_name_role', $this->post('alias_name_role'));
    $this->permission->insert($this->setRole($role_added->id));
    Session::setFlashMessage('FLASH_SUCCESS', 'Role added correctly');

    redirect('role-permissions');
  }
}