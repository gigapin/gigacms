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

use Exception;
use Src\Model;
use Src\QueryBuilder;

/** 
 * @package GiGaCMS\Posts
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see QueryBuilder
 */
class Post extends QueryBuilder
{
  /**
   * Get id from posts table and username from users table where
   * user_id in posts table is equal to id in users table.
   *
   * @return array
   * @throws Exception
   */
	public function users(): array
	{
		$sql = "SELECT posts.id, users.username 
			FROM posts INNER JOIN users 
			ON posts.user_id = users.id";
			
		$stmt = Model::getDB()->query($sql);
		
		return $stmt->fetchAll(\PDO::FETCH_OBJ);
	}

  /**
   * Get username from users table where user_id in posts table
   * is equal to id in users table and id from posts is matched to $id argument.
   *
   * @param integer $id
   * @return array
   * @throws Exception
   */
	public function user(int $id): array 
	{
		$sql = "SELECT users.username 
			FROM posts INNER JOIN users 
			ON posts.user_id = users.id
			AND posts.id = $id";

		$stmt = Model::getDB()->query($sql);
		
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	
}