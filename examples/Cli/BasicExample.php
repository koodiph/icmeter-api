#!/usr/bin/php
<?php

include __DIR__ . '/../../../vendor/autoload.php';
include __DIR__ . '/../../config.php';

use ICMeter\API\PHP\Api\Client;
use ICMeter\API\PHP\Api\Helper;
use ICMeter\API\PHP\Api\Exception\ClientException;
use ICMeter\API\PHP\Common\Scopes;

$scope = Scopes::SCOPE_READ_STATION;

$client = new Client(array(
    'client_id'     => $client_id,
    'client_secret' => $client_secret,
    'username'      => $test_username,
    'password'      => $test_password,
    'scope'         => Scopes::SCOPE_TRUST,
));

$helper = new Helper($client);

try {
    $tokens = $client->getAccessToken();
} catch(ClientException $ex) {
    echo "An error happend while trying to retrieve your tokens\n";
    exit(-1);
}

echo ("-------------\n");
echo ("- Indoor Measurements -\n");
echo ("-------------\n");
$measurements = $helper->measurements('10 minute ago');
print_r($measurements);
echo ("OK\n");

echo ("---------------\n");
echo ("- Weather Measurements -\n");
echo ("---------------\n");
$measurements = $helper->weatherMeasurements();
print_r($measurements);
echo ("OK\n");
