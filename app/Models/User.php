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

namespace App\Models;

use Src\Model;
use Src\QueryBuilder;

/** 
 * @package GiGaCMS\Users
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see QueryBuilder
 */
class User extends QueryBuilder
{
  	/**
	 * Maximum length of characters allowed for username field.
	 *   
	 * @access public
	 * @var integer
	 */
	public int $max_username = 20;

	/**
	 * Minimum length of characters allowed for username field.
	 *   
	 * @access public
	 * @var integer
	 */
	public int $min_username = 3;

	/**
	 * Maximum length of characters allowed for name field.
	 *   
	 * @access public
	 * @var integer
	 */
	public int $max_name = 50;

	/**
	 * Minimum length of characters allowed for name field.
	 *   
	 * @access public
	 * @var integer
	 */
	public int $min_name = 3;

	/**
	 * Maximum length of characters allowed for password field.
	 *   
	 * @access public
	 * @var integer
	 */
	public int $max_password = 16;

	/**
	 * Minimum length of characters allowed for password field.
	 *   
	 * @access public
	 * @var integer
	 */
	public int $min_password = 8;

  /**
   * Get role name from users table. 
   * 
   * @return mixed
   */
	public function role(): mixed
  {
    $sql = "SELECT roles.name_role FROM
      users INNER JOIN roles
      ON users.role = roles.id";
    $stmt = Model::getDB()->query($sql);

    return $stmt->fetch(\PDO::FETCH_OBJ);
  }

	public function roles(int $id = 2): mixed
  {
    $sql = "SELECT roles.name_role FROM
      users INNER JOIN roles
      ON users.role = roles.id
			AND roles.id = $id";
    $stmt = Model::getDB()->query($sql);

    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }
}