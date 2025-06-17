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
 * @package GiGaCMS/Menu
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see QueryBuilder
 */
class Menu extends QueryBuilder
{
  /**
   * @throws \Exception
   */
  public function user()
  {
    $query = "SELECT menus.created_by, users.username 
      FROM menus INNER JOIN users
      ON menus.created_by = users.id";
    $stmt = Model::getDB()->query($query);
    
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }
}