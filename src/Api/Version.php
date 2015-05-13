<?php

namespace ICMeter\API\PHP\Api;

class Version
{
    const CURRENT = '1.1';

    public function __toString()
    {
        return static::CURRENT;
    }
}
