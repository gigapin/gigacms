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

namespace App\Controllers\Admin;

use Exception;
use Src\Auth;
use Src\Controller;
use App\Models\Post;
use Src\View;

/**
 * @package GiGaCMS/Dashboard
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class DashboardController extends Controller
{
  protected object $posts;

  public function __construct()
  {
    $this->posts = new Post('posts');  
  }

  /**
   * Display a listing of activities of the users.
   *
   * @return View
   * @throws Exception
   */
  public function index(): void
  {
    view('dashboard/index', [
      'posts' => $this->posts->findLatest('user_id', Auth::id(), 6),
      'username' => $this->posts->users(),
    ]);
  }
}