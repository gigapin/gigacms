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
	 * @access private
	 * @var object
	 */
	private object $user;

	/**
	 * Maximum length of characters allowed for username field.
	 *   
	 * @access protected
	 * @var integer
	 */
	protected int $max_username = 20;

	/**
	 * Minimum length of characters allowed for username field.
	 *   
	 * @access protected
	 * @var integer
	 */
	protected int $min_username = 3;

	/**
	 * Maximum length of characters allowed for name field.
	 *   
	 * @access protected
	 * @var integer
	 */
	protected int $max_name = 50;

	/**
	 * Minimum length of characters allowed for name field.
	 *   
	 * @access protected
	 * @var integer
	 */
	protected int $min_name = 3;

	/**
	 * Maximum length of characters allowed for password field.
	 *   
	 * @access protected
	 * @var integer
	 */
	protected int $max_password = 16;

	/**
	 * Minimum length of characters allowed for password field.
	 *   
	 * @access protected
	 * @var integer
	 */
	protected int $min_password = 8;

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
				'max' => $this->max_username,
				'min' => $this->min_username
			],
			'name' => [
				'max' => $this->max_name,
				'min' => $this->min_name
			],
			'email' => ['email'],
			'password' => [
				'max' => $this->max_password,
				'min' => $this->min_password
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
