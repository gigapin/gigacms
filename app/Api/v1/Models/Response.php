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

namespace App\Api\v1\Models;

class Response
{
  /**
   * @var string
   */
  private string $_success;

  /**
   * @var int
   */
  private int $_httpStatusCode;

  /**
   * @var array
   */
  private array $_messages;

  /**
   * @var mixed
   */
  private mixed $_data;

  /**
   * @var bool
   */
  private bool $_toCache = false;

  /**
   * @var array
   */
  private array $_responseData = array();

  /**
   * @param $success
   * @return void
   */
  public function setSuccess($success): void
  {
    $this->_success = $success;
  }

  /**
   * @param $httpStatusCode
   * @return void
   */
  public function setHttpStatusCode($httpStatusCode): void
  {
    $this->_httpStatusCode = $httpStatusCode;
  }

  /**
   * @param $messages
   * @return void
   */
  public function addMessage($messages): void
  {
    $this->_messages[] = $messages;
  }

  /**
   * @param $data
   * @return void
   */
  public function setData($data): void
  {
    $this->_data = $data;
  }

  /**
   * @param $toCache
   * @return void
   */
  public function toCache($toCache): void
  {
    $this->_toCache = $toCache;
  }

  /**
   * @param $data
   * @return void
   */
  public function responseData($data): void
  {
    $this->_responseData[] = $data;
  }

  /**
   * @return void
   */
  public function send(): void
  {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-type: application/json;charset=utf-8');
    if ($this->_toCache) {
      header('Cache-control: max-age=60');
    } else {
      header('Cache-control: no-cache, no-store');
    }
    
    if ((!$this->_success) || !is_numeric($this->_httpStatusCode)) {
      http_response_code(500);
      $this->_responseData['statusCode'] = 500;
      $this->_responseData['success'] = false;
      $this->addMessage('Response creation error');
      $this->_responseData['messages'] = $this->_messages;
    } else {
      http_response_code($this->_httpStatusCode);
      $this->_responseData['statusCode'] = $this->_httpStatusCode;
      $this->_responseData['success'] = $this->_success;
      $this->_responseData['messages'] = $this->_messages;
      $this->_responseData['data'] = $this->_data;
    }

    echo json_encode($this->_data);
  }

}