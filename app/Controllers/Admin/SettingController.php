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

use Src\Auth;
use Src\Controller;
use App\Models\User;
use Src\Http\Request;
use App\Models\Access;
use App\Models\Status;
use Src\CSRFToken;
use Src\Session\Session;
use Src\Exceptions\AuthException;

/**
 * 
 * @package GiGaCMS\Posts
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class SettingController extends Controller
{

  /** @var object */
  protected object $access;
  protected object $status;
  protected object $user;

  public function __construct()
  {
    $this->access = new Access('access');
    $this->status = new Status('status');
    $this->user = new User('users');
  }
  public function cleanCache()
  {
    return Session::remove('errors');
  }

  /**
   * Display a listings of settings to manage.
   *
   * @return mixed
   */
  public function index(): mixed
  {
    $role = $this->user->findWhere('username', Session::get('user'));
    
    try {
      if ($role->role !== 1 && $role->role !== 2) {
        throw new AuthException('Cannot access to this resource');
      }
      return view('settings/index', [
        'list_status' => $this->status->findAll(),
        'list_access' => $this->access->findAll(),
        'token' => CSRFToken::token()
      ]);
    } catch (AuthException $auth) {
        printf('%s %d', $auth->getMessage(), $auth->getCode());
        exit();
    }
  }

  public function store()
  {
    //dd(Request::all());
  }
}