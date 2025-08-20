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
use Src\CSRFToken;
use Src\Controller;
use App\Models\User;
use Src\Authorization\Authorization;
use Src\Http\Redirect;
use Src\Session\Session;
use Src\View;

/**
* @package GiGaCMS/Login
* @author Giuseppe Galari <gigaprog@proton.me>
* @version 1.0.0
* @see Controller
*/
class LoginController extends Controller
{
	/**
	 * @access protected
	 * @var object
	 */
	protected object $model;

	/**
	 * @access protected
	 * @var integer
	 */
	protected int $max_length = 16;

	/**
	 * @access protected
	 * @var integer
	 */
	protected int $min_length = 8;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->model = new User('users');
	}

  /**
   * Display a form for log in.
   *
   * @return void
   * @throws Exception
   */
	public function login(): void
  {
		view('auth/login', [
			'token' => CSRFToken::token()
		]);
	}

  /**
   * Checks if credentials entered from the user are valid.
   *
   * @return int|View|bool
   * @throws Exception
   */
	public function sign_in(): int|View|bool
  {
		CSRFToken::verifyToken();
		$errors = $this->request()->validate([
			'email' => [
				'email'
			],
			'password' => [
				'max' => $this->max_length,
				'min' => $this->min_length
			]
		]);
		
		if ($errors) {
			view('auth/login', ['errors' => $errors]);
		}
		
		try {	
			$pass = $this->model->findWhere('email', $this->post('email'));
			
			if (! $pass || ! password_verify($this->post('password'), $pass->password)) {
				throw new Exception('Credentials entered not are valid');
			} 
			
			Session::set('user', $pass->username);
			Redirect::to('dashboard');

			return true;
		} catch (Exception $exc) {
			return printf("%s", $exc->getMessage());
		}
	}

  /**
   * Destroy user session and redirect him to login page.
   *
   * @return void
   * @throws Exception
   */
	public function logout(): void
  {
		Session::remove('user');
		redirect('login');
	}
}