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

return [
  /**
   * Enter what database driver you need for your application.
   */
  'connection' => 'MYSQL',
  /**
   * Set credentials for database selected.
   */
  'DB_DRIVERS' => [
    'MYSQL' => [
      'DB_HOST' => 'localhost',
      'DB_USER' => 'root',
      'DB_NAME' => 'gigacms_db',
      'DB_PASS' => '13esimoFloor',
    ],
    'SQLITE' => [
      'FILE' => 'storage/database/sqlite.db'
    ],
    'PGSQL' => [
      'DB_HOST' => 'localhost',
      'DB_USER' => '',
      'DB_NAME' => '',
      'DB_PASS' => '',
    ],
  ]
];
