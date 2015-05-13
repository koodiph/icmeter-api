<?php

namespace ICMeter\API\PHP\Api\Exception;

use ICMeter\API\PHP\Common\ErrorType;

class CurlErrorTypeException extends ClientException
{
    function __construct($code, $message)
    {
        parent::__construct($code, $message, ErrorType::CURL_ERROR_TYPE);
    }
}
