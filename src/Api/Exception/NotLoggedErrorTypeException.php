<?php

namespace ICMeter\API\PHP\Api\Exception;

use ICMeter\API\PHP\Common\ErrorType;

class NotLoggedErrorTypeException extends ClientException
{
    function __construct($code, $message)
    {
        parent::__construct($code, $message, ErrorType::NOT_LOGGED_ERROR_TYPE);
    }
}
