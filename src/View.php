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
use Src\Http\Redirect;
use Src\Session\Session;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

/**
 * @package GiGaFlow\View
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class View
{
  /**
   * Rendering of the application.
   *
   * @param string $path
   * @param array $data
   * @return mixed
   * @throws Exception
   */
  public static function render(string $path, array $data = []): mixed
  {
    extract($data, EXTR_SKIP);
    $realPath = realpath(__DIR__ . "/../resources/views/" . $path . ".php");
    try {
      if (file_exists($realPath) && is_readable($realPath)) {
        if (Session::has('user')) {
          return require __DIR__ . "/../resources/views/$path.php";
        } else {
          return require __DIR__ . "/../resources/views/auth/login.php";
        }
      } else {
        throw new Exception("$realPath not found");
      }
    } catch (Exception $exc) {
      printf("%s", $exc->getMessage());
    } 
  }

  /**
   * Rendering with Twig Template.
   *
   * @param $template
   * @param array $args
   */
  public static function renderTemplate($template, array $args = [])
  {
    static $twig = null;
    if ($twig === null) {
      $loader = new FilesystemLoader(__DIR__ . '/../resources/views');
      $twig = new Environment($loader);
    }

    try {
      if (isset($_SESSION['flash_message']['FLASH_SUCCESS'])) {
        $args['session'] = $_SESSION['flash_message']['FLASH_SUCCESS'];
        unset($_SESSION['flash_message']['FLASH_SUCCESS']);
      }
      if (isset($_SESSION['user'])) {
        $args['sessionuser'] = $_SESSION['user'];
      }
      echo $twig->render($template, $args);
    } catch (LoaderError | RuntimeError | SyntaxError $e) {
      echo $e->getMessage();
    }
  }

  /**
   * Rendering of a page that show a 404 error message.
   * 
   * @param string $exception
   * @static
   * @return void
   */
  public static function show404(string $exception): void
  {
    self::render('errors/show404', compact('exception'));
  }

  /**
   * Rendering of a page that show a 500 error message.
   * 
   * @param array $exception
   * @static
   * @return void
   */
  public static function show500(array $exception = []): void
  {
    self::render('errors/show500', ['exception' => $exception]);
  }

  /**
   * Rendering of a page that show a error message.
   * 
   * @param array $errors
   * @static
   * @return void
   */
  public static function showError(array $errors = []): void
  {
    self::render('errors/error', ['errors' => $errors]);
  }

 /**
   * Rendering of a page that show a error message about an exception raised.
   * 
   * @param string $exception
   * @static
   * @return void
   */
  public static function showErrorException($exception): void
  {
    self::render('errors/errorException', compact('exception'));
  }

  /**
   * Rendering of a page that show a message about an exception raised.
   * 
   * @param string $exception
   * @static
   * @return void
   */
  public static function showException(string $exception): void
  {
    self::render('errors/showException', compact('exception'));
  }
}
