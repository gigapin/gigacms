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

use App\Models\Access;
use App\Models\Status;
use Exception;
use Src\CSRFToken;
use Src\Controller;
use App\Models\User;
use App\Models\Setting;
use Src\Session\Session;
use Src\Exceptions\AuthException;
use Src\Http\Request;
use Src\View;

/**
 * 
 * @package GiGaCMS\Posts
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class SettingController extends Controller
{

  protected Access $access;
  protected Status $status;
  protected User $user;
  protected Setting $setting;

  /**
   * Listing of options setting available
   * 
   * @var array
   */
  protected array $options = [
    'site_name',
    'site_offline',
    'level_post_access',
    'meta_description',
    'robots',
    'author',
    'categories',
    'comments',
    'post_access',
    'post_status',
    'user_registration'
  ];

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->user = new User('users');
    $this->setting = new Setting('settings');
  }

  /**
   * @throws Exception
   */
  public function cleanCache(): void
  {
    Session::remove('errors');
  }

  /**
   * Display a listings of settings to manage.
   *
   * @return View
   * @throws Exception
   */
  public function index(): View
  {
    $role = $this->user->findWhere('username', Session::get('user'));
   
    try {
      if ($role->role !== 1 && $role->role !== 2) {
        throw new AuthException('Cannot access to this resource');
      }

      return view('settings/index', [
        'token' => CSRFToken::token(),
        'settings' => $this->setting
      ]);
    } catch (AuthException $auth) {
        printf('%s %d', $auth->getMessage(), $auth->getCode());
        exit();
    }
  }

  /**
   * Storing options changed
   *
   * @return void
   * @throws Exception
   */
  public function store(): void
  {
    $data = array();

    if (is_null($this->setting->findAll())) {
      foreach (Request::multiPost('option_name') as $option_name => $option_value) {
        $this->setting->insert([
          'option_name' => $option_name,
          'option_value' => $option_value
        ]);
      }
    } else {
      foreach (Request::multiPost('option_name') as $option_name => $option_value) {
        $data[] = $option_name;
      }
    }
   
    foreach ($this->options as $option) {
      if (in_array($option, $data, true)) {
        foreach (Request::multiPost('option_name') as $option_name => $option_value) {
          $this->setting->updateWhere('option_name', $option_name, [
            'option_name' => $option_name,
            'option_value' => $option_value
          ]);
        }
      } else {
        $this->setting->updateWhere('option_name', $option, [
          'option_name' => $option,
          'option_value' => null
        ]);
      }
    }

    redirect('settings');
  }
}