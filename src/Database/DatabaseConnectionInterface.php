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

namespace Src\Database;

use PDO;

/**
 * 
 * @package GiGaFlow\Database
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
interface DatabaseConnectionInterface
{
    /**
     * Start database connection
     *
     * @return PDO
     */
    public function open(): PDO;

  /**
   * Close database connection
   *
   * @return PDO|null
   */
    public function close(): ?PDO;

}