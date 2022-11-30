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
	 * @return mixed
	 */
	public function login(): mixed
	{
		return view('auth/login', [
			'token' => CSRFToken::token()
		]);
	}

	/**
	 * Checks if credentials entered from the user are valid.
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function signin(): mixed
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
			return view('auth/login', ['errors' => $errors]);
		}
		
		try {	
			$pass = $this->model->findWhere('email', $this->post('email'));
			
			if (! $pass || ! password_verify($this->post('password'), $pass->password)) {
				throw new Exception('Credentials entered not are valid');
			} 
			
			Session::set('user', $pass->username);
			Redirect::to('dashboard');
			
		} catch (\Exception $exc) {
			printf("%s", $exc->getMessage());
		}
	}

	/**
	 * Destroy user session and redirect him to login page.
	 *
	 * @return mixed
	 */
	public function logout(): mixed
	{
		Session::remove('user');
		return redirect('login');
	}
}