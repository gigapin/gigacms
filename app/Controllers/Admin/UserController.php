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
use Src\CSRFToken;
use Src\Controller;
use App\Models\Role;
use App\Models\User;
use Src\Http\Request;
use App\Models\RoleUser;
use Src\Exceptions\AuthException;
use Src\Session\Session;
use Src\Validation\ValidateRequest;

/**
 * 
 * @package GiGaCMS\Posts
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class UserController extends Controller
{
  /**
   * Create an instance of the User model class.
   * 
   * @access protected
   * @var object
   */
  protected object $user;

  /**
   * Create an instance of the Status model class.
   * 
   * @access protected
   * @var object
   */
  protected object $status;

  /**
   * Create an instance of the Role model class.
   * 
   * @access protected
   * @var object
   */
  protected object $role;

  /**
   * Create an instance of the RoleUser model class.
   * 
   * @access protected
   * @var object
   */
  protected object $role_user;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->user = new User('users');
    $this->role = new Role('roles');
    $this->role_user = new RoleUser('role_users');
  }

  /**
   * \Setting rules validation.
   *
   * @access private
   * @return array
   */
  private function setValidationRule(): array
  {
    return [
      'username' => [
        'required' => true,
				'max' => $this->user->max_username,
				'min' => $this->user->min_username,
        'unique' => [true, new User('users')]
			],
			'name' => [
        'required' => true,
				'max' => $this->user->max_name,
				'min' => $this->user->min_name
			],
			'email' => [
        'email',
        'unique' => [true, new User('users')]
      ],
			'password' => [
        'required' => true,
				'max' => $this->user->max_password,
				'min' => $this->user->min_password,
        'match_password'
			]
    ];
  }

  /**
   * Getting data from a form.
   *
   * @access private
   * @return array
   */
  private function getData(): array
  {
    return [
      'username' => $this->post('username'),
      'name' => $this->post('name'),
      'email' => $this->post('email'),
      'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
      'role' => $this->post('role'),
      'status' => $this->post('status'),
      'created_by' => Auth::id()
    ];
  }

  /**
   * Displ;ay a listing of all users created.
   *
   * @return mixed
   */
  public function index(): mixed
  {
    $role = $this->user->findWhere('username', Session::get('user'));
    
    try {
      if ($role->role !== 1 && $role->role !== 2) {
        throw new AuthException('Cannot access to this resource');
      }
      return view('users/index', [
        'users' => $this->user->findAll(),
        'user_role' => $this->user->role(),
        'roles' => $this->role->findAll()
      ]);
    } catch (AuthException $auth) {
      printf('%s %d', $auth->getMessage(), $auth->getCode());
      exit();
    }
  }

  /**
   * Display a form for create a new user.
   *
   * @return mixed
   */
  public function create(): mixed
  {
    $role = $this->user->findWhere('username', Session::get('user'));
    
    try {
      if ($role->role !== 1 && $role->role !== 2) {
        throw new AuthException('Cannot access to this resource');
      }
      return view('users/create', [
        'roles' => $this->role->findAllWhereNot('alias_name_role', 'root'),
        'token' => CSRFToken::token()
      ]);
    } catch (AuthException $auth) {
      printf('%s %d', $auth->getMessage(), $auth->getCode());
      exit();
    }
  }

  /**
   * Storing data of the user added.
   *
   * @return mixed
   */
  public function store(): mixed 
  {
    if (! is_null(Request::validate($this->setValidationRule()))) {
      return ValidateRequest::storingSession($this->setValidationRule(), 'users/create'); 
    }
    ValidateRequest::unsetSession();
        
    $this->user->insert($this->getData());
    $user = $this->user->findWhere('username', $this->getData()['username']);
    $this->role_user->insert([
      'user_id' => $user->id,
      'role_id' => $user->role,
      'created_by' => Auth::id()
    ]);
    Session::setFlashMessage('FLASH_SUCCESS', 'User created successfully');

    return redirect('users');
  }

  /**
   * Show a form to modify data of a user.
   *
   * @param integer $id
   * @throws \Exception
   * @return mixed
   */
  public function edit(int $id): mixed
  {
    $getUser = $this->user->findById($id);
    $role = $this->user->findWhere('username', Session::get('user'));
    
    try {
      if ($role->role !== 1 && $role->role !== 2) {
        throw new AuthException('Cannot access to this resource');
      }
      if (! $getUser) {
        throw new \Exception('User Not Found');
      }


      return view('users/edit', [
        'user' => $getUser,
        'token' => CSRFToken::token(),
        'user_role' => $this->user->role(),
        'roles' => $this->role->findAllWhereNot('alias_name_role', 'root'),
      ]);
    } catch (\Exception $exc) {
      printf('%s', $exc->getMessage());
    } catch (AuthException $auth) {
      printf('%s %d', $auth->getMessage(), $auth->getCode());
      exit();
    }
  }

  /**
   * Storing updated data of a specific user.
   *
   * @param integer $id
   * @return mixed
   */
  public function update(int $id): mixed
  {
    if (! is_null(Request::validate($this->setValidationRule()))) {
      return ValidateRequest::storingSession($this->setValidationRule(), 'users/edit/' . $id); 
    }
    ValidateRequest::unsetSession();

    $this->user->update($id, $this->getData());
    $user = $this->user->findWhere('username', $this->getData()['username']);
    $role = $this->role_user->findWhere('user_id', $user->id);
    $this->role_user->update($role->id, [
      'user_id' => $user->id,
      'role_id' => $user->role,
      'created_by' => Auth::id()
    ]);
    Session::setFlashMessage('FLASH_SUCCESS', 'User updated successfully');

    return redirect('users/edit/' . $id);
  }

  /**
   * Remove a specific user.
   *
   * @param integer $id
   * @throws \Exception
   * @return mixed   
   */
  public function delete(int $id): mixed 
  {
    $role = $this->user->findWhere('username', Session::get('user'));
    
    try {
      if ($role->role !== 1 && $role->role !== 2) {
        throw new AuthException('Cannot access to this resource');
      }
      if (! $this->user->findById($id)) {
        throw new \Exception('User Not Found');
      }

      $this->user->delete($id);

      return redirect('users');
    } catch (\Exception $exc) {
        printf('%s', $exc->getMessage());
    } catch (AuthException $auth) {
        printf('%s %d', $auth->getMessage(), $auth->getCode());
        exit();
    }
  }
}