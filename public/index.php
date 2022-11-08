<?php
/*
 * This file is part of the GiGaCMS package.
 *
 * (c) Giuseppe Galari <gigaprog@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
ini_set('display_errors', 1);

$root = realpath(dirname(__FILE__));
require_once  $root . "/../vendor/autoload.php";
require $root . "/../helpers/functions.php";

use Src\Application\Application;

$app = new Application();
$app->run();
