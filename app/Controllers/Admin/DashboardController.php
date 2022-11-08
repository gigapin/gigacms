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

use Src\Controller;
use Src\Session\Session;

/**
 * @package GiGaCMS/Dashboard
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of activities and data about users.
     *
     * @return mixed
     */
    public function index(): mixed
    {
        return view('dashboard/index', [
            'sessionuser' => Session::get('user')
        ]);
    }
}