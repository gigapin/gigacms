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

namespace Src;

use Exception;
use Src\Http\Request;

/**
 * @package GiGaFlow\Controller
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
abstract class Controller
{
  /**
   * Rendering of a html page.
   *
   * @param string $path
   * @param array $data
   * @return mixed
   * @throws Exception
   */
  public function render(string $path, array $data = []): mixed
  {
    return View::render($path, $data);
  }

  /**
   * Rendering of the html page within Twig template.
   *
   * @param string $path
   * @param array $data
   * @return mixed
   * @throws Exception
   */
  public function template(string $path, array $data = []): mixed
  {
    return View::renderTemplate($path, $data);
  }

  /**
   * Instance of the Request class.
   *
   * @return Request
   */
  public function request(): Request
  {
    if (class_exists('Src\Http\Request')) {
      return new Request;
    }
  }

  /**
   * Get data from a POST request.
   *
   * @param string $value
   * @return string
   */
  public function post(string $value): string
  {
    return Request::post($value);
  }

  /**
   * Get data from a GET request.
   *
   * @param string $value
   * @return string
   */
  public function get(string $value): string
  {
    return Request::get($value);
  }

  /**
   * Get the file data from a file uploaded.
   *
   * @param string $value
   * @return array
   */
  public function file(string $value): array
  {
    return Request::file($value);
  }
}
