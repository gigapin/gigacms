<?php
/*
 * This file is part of the GiGaFlow package.
 *
 * (c) Giuseppe Galari <gigaprog@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Src;

use Src\Session\Session;
use Src\QueryBuilder;

/**
 * @package GiGaFlow\Auth
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class Auth 
{
	/**
	 * Object to instance QueryBuilder class.
	 *
	 * @static
	 * @var object
	 */
	protected static object $model;

	/**
	 * Initialize QueryBuilder class.
	 *
	 * @access protected
	 * @return QueryBuilder
	 */
	protected static function init(): QueryBuilder
	{
		self::$model = new QueryBuilder('users');
		return self::$model;
	}

	/**
	 * Get id from user authenticated.
	 *
	 * @return mixed
	 */
	public static function id(): mixed
	{
		$user = Session::get('user');
		return self::init()->findWhere('username', $user)->id;
	}

}