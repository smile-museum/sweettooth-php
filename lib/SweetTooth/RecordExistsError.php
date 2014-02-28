<?php

class SweetTooth_RecordExistsError extends SweetTooth_InvalidRequestError
{
  public function __construct($message, $param, $http_status=null, $http_body=null, $json_body=null)
  {
    parent::__construct($message, $param, $http_status, $http_body, $json_body);
    
    $this->recordId = null;
    if ($json_body) {
      $this->recordId = isset($json_body['record_id']) ? $json_body['record_id'] : null;
    }
  }
}
