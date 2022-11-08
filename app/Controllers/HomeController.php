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

namespace App\Controllers;

use Src\Controller;
use Src\Http\Redirect;

class HomeController extends Controller
{
  public function index()
  {
    Redirect::to('login');
  }
}