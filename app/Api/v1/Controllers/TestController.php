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

namespace App\Api\v1\Controllers;

use Src\Controller;
use App\Api\v1\Models\Response;

class TestController extends Controller
{
  public function index(): void
  {
    $res = new Response();
    $res->setSuccess(true);
    $res->setHttpStatusCode(200);
    $res->addMessage("Test message");
    $res->addMessage("Test message 2");
    $res->send();
  }
}