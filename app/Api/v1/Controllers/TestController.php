<?php

namespace App\Api\v1\Controllers;

use Src\Controller;
use App\Api\v1\Models\Response;

class TestController extends Controller
{
  public function index()
  {
    $res = new Response();
    $res->setSuccess(true);
    $res->setHttpStatusCode(200);
    $res->addMessage("Test message");
    $res->addMessage("Test message 2");
    $res->send();
  }
}