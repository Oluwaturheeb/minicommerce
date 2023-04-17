<?php
namespace App\Http\Services;

class Service {
  public function formattedResponse($status, $message, $redirectUrl = null, $data = []) {
    $response = new \stdClass();
    $response->status = $status;
    $response->message = $message;
    $response->redirectUrl = $redirectUrl;
    $response->data = $data;

    return $response;
  }
}