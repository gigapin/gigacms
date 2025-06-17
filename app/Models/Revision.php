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
 * 
 * @package GiGaCMS\Revision
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see QueryBuilder
 */
class Revision extends QueryBuilder
{
  /**
   * @throws Exception
   */
  public function user()
  {
    $sql = "SELECT user_id 
      FROM revisions INNER JOIN posts 
      ON revisions.post_id = posts.id";
    $stmt = Model::getDB()->query($sql);

    return $stmt->fetch(\PDO::FETCH_OBJ);
  }
}