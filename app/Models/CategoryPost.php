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
use PDO;
use Src\Model;
use Src\QueryBuilder;

/** 
 * @package GiGaCMS\CategoryPost
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see QueryBuilder
 */
class CategoryPost extends QueryBuilder
{
  /**
   * Get post_id from category_post, id and category_name from categories
   * where category_id from category_post is equal to id from categories
   * and post_id from category_post is matched $id argument.
   *
   * @param integer $id
   * @return mixed
   * @throws Exception
   */
	public function post(int $id): mixed
	{
		$sql = "SELECT category_post.post_id, categories.id, categories.category_name 
			FROM category_post INNER JOIN categories
			ON category_id = categories.id
			AND category_post.post_id = $id
			";

		$stmt = Model::getDB()->query($sql);

		return $stmt->fetch(PDO::FETCH_OBJ);
	}

  /**
   * Get category_name from categories, category_id and post_id from category_post
   * where category_id from category_post is equal id in categories table.
   *
   * @return array
   * @throws Exception
   */
	public function category(): array
	{
		$sql = "SELECT category_post.category_id, category_post.post_id, categories.category_name
			FROM category_post INNER JOIN categories
			ON category_post.category_id = categories.id";

		$stmt = Model::getDB()->query($sql);

		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}	
}