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

use Src\Controller;
use App\Models\Role;
use App\Models\User;
use Src\Auth;
use Src\CSRFToken;
use Src\Http\Request;
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
   * Constructor
   */
  public function __construct()
  {
    $this->user = new User('users');
    $this->role = new Role('roles');
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
    return view('users/index', [
      'users' => $this->user->findAll(),
      'role' => $this->user->role()
    ]);
  }

  /**
   * Display a form for create a new user.
   *
   * @return mixed
   */
  public function create(): mixed
  {
    return view('users/create', [
      'roles' => $this->role->findAllWhereNot('alias_name_role', 'root'),
      'token' => CSRFToken::token()
    ]);
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
  public function edit(int $id):mixed
  {
    $getUser = $this->user->findById($id);
    try {
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
    try {
      if (! $this->user->findById($id)) {
        throw new \Exception('User Not Found');
      }
      $this->user->delete($id);

      return redirect('users');
    } catch (\Exception $exc) {
      printf('%s', $exc->getMessage());
    }
  }
}