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

use App\Models\User;
use Src\Controller;
use Src\CSRFToken;
use Src\Http\Redirect;


/**
 * @package GiGaCMS/Register
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class RegisterController extends Controller
{
	/**
	 * @access protected
	 * @var object
	 */
	protected object $user;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->user = new User('users');
	}

	/**
	 * Display a form for create a new user.
	 *
	 * @return mixed
	 */
	public function register(): mixed
	{
		return view('auth/register', [
			'token' => CSRFToken::token()
		]);
	}

	/**
	 * Storing data for create a new user instance.
	 *
	 * @return mixed
	 */
	public function signup(): mixed
	{
		$errors = $this->request()->validate([
			'username' => [
				'max' => $this->user->max_username,
				'min' => $this->user->min_username
			],
			'name' => [
				'max' => $this->user->max_name,
				'min' => $this->user->min_name
			],
			'email' => ['email'],
			'password' => [
				'max' => $this->user->max_password,
				'min' => $this->user->min_password
			]
		]);
		if ($this->post('password') !== $this->post('password-confirm')) {
			$errors[] = "Passoword not matched!";
		}
		if ($errors) {
			return view('auth/register', ['errors' => $errors]);
		}
		
		$data = [
			'name' => $this->post('name'),
			'username' => $this->post('username'),
			'email' => $this->post('email'),
			'password' => password_hash($this->post('password'), PASSWORD_DEFAULT)
		];
		
		$this->user->insert($data);
		
		Redirect::to('login');
	}
}
