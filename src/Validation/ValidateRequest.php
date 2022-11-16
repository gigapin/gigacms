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

namespace Src\Validation;

use Src\Http\Request;
use Src\Http\Redirect;
use Src\Session\Session;

/**
 * 
 * @package GiGaFlow\Validation
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class ValidateRequest
{
  /** 
   * Storing errors.
   * 
   * @static
   * @var array  
   */
  public static array $errors = [];

  /**
   * The field is mandatory.
   * 
   * @param string $input
   * @param string|null $value
   * @param string $rule
   * @static
   * @return void
   */
  public static function required(string $input, string|null $value, string $rule): void
  {
    if (((int) $rule === 1 && $value === '') || ((int) $rule === 1 && $value === null)) {
      self::$errors[] = "$input: Field is required";
    }
  }

  /**
   * Length minimum of characters available.
   * 
   * @param string $input
   * @param string $value
   * @param string $rule
   * @static
   * @return void
   */
  public static function min(string $input, string $value, string $rule): void
  {
    if (strlen($value) < (int) $rule) {
      self::$errors[$input] = "$input is too short";
    }
  }

  /**
   * Length maximum of characters available.
   * 
   * @param string $input
   * @param string $value
   * @param int $rule
   * @static
   * @return void
   */
  public static function max(string $input, string $value, int $rule): void
  {
    if (strlen($value) > $rule) {
      self::$errors[$input] = "$input is too long";
    }
  }

  /**
   * Validation for email address.
   * 
   * @param string $input
   * @param string $value
   * @static
   * @return void
   */
  public static function email(string $input, string $value): void
  {
    if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
      self::$errors[$input] = "Email address not valid";
    }
  }

  /**
   * Set rules for create a valid title of posts.
   * 
   * @param string $input
   * @param string $value
   * @static
   * @return void
   */
  public static function title(string $input, string $value): void
  {
    if (!preg_match("/^([a-z0-9\s]+)([\?!]*)([a-z]*)$/i", $value)) {
      self::$errors[$input] = "Allowed only alpha characters, question and exclamation mark";
    }
  }

  /**
   * Rule that allowed of enterd only alpha characters.
   * 
   * @param string $input
   * @param string $value
   * @static
   * @return void
   */
  public static function string(string $input, string $value): void
  {
    if (!preg_match("/^([a-z]+)$/i", $value)) {
      self::$errors[$input] = "Allowed only alpha characters";
    }
  }

  /**
   * Rule that allowed of enterd only numeric characters.
   * 
   * @param string $input
   * @param string $value
   * @static
   * @return void
   */
  public static function number(string $input, string $value): void
  {
    if (preg_match("/^([a-z]+)$/i", $value)) {
      self::$errors[$input] = "Allowed only number characters";
    }
  }

  /**
   * Check if a date entered is older of the current time.
   *
   * @param string $input
   * @param string $value
   * @static
   * @return void
   */
  public static function now(string $input, string $value): void
  {
    $date = date_create($value);
    $time = date_timestamp_get($date);
    if ($time < time()) {
      self::$errors[$input] = "The date cannot be older of the current time";
    }
  }

  /**
   * Display all errors stored.
   *
   * @static
   * @return mixed
   */
  public static function getErrors(): mixed
  {
    if (count(self::$errors) > 0) {
      if (Session::has('errors')) {
        unset($_SESSION['errors']);
      }
      return Session::set('errors', self::$errors);
    }

    return null;
  }

   /**
   * Sessions about validation data.
   * 
   * @access private
   * @static
   */
  public static function storingSession(array $errors)
  {
    if (Request::validate($errors) !== null) {
      Session::remove('data-form');
      Session::set('data-form', Request::all());
      return Redirect::to('posts/create');
    } elseif (Session::has('data-form')) {
        Session::remove('data-form');
        Session::remove('errors');
    } else {
      return null;
    }
  }

  /**
   * Update sessions for validation data.
   *
   * @param object $updatePost
   * @static
   */
  public static function updateSession(object $updatePost, array $errors)
  {
    if (Request::validate($errors) !== null) {
      return redirect('posts/edit/' . $updatePost->post_name);
    } elseif (Session::has('errors')) {
      Session::remove('errors');
    } else {
      return null;
    }
  }
}
