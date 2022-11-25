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
 * 
 * @package GiGaCMS\Posts
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see QueryBuilder
 */
class DefaultRolePermission extends QueryBuilder
{
  /**
   * Get name of the a role in relation with role_permissions table.
   *
   * @return mixed
   */
  public function role(): mixed
  {
    $query = "SELECT roles.name_role, roles.id FROM
      role_permissions INNER JOIN roles
      ON role_permissions.role_id = roles.id";
    $stmt = Model::getDB()->query($query);
    
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }
}