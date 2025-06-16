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

namespace App\Controllers;

use Src\Controller;
use Src\Http\Redirect;

/**
 * 
 * @package GiGaCMS\Controllers
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class HomeController extends Controller
{
  public function index(): void
  {
    Redirect::to('login');
  }
}