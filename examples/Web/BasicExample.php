<?php

include __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../config.php';

use ICMeter\API\PHP\Api\Client;
use ICMeter\API\PHP\Api\Formatter;
use ICMeter\API\PHP\Api\Helper;
use ICMeter\API\PHP\Api\Exception\ClientException;
use ICMeter\API\PHP\Common\Scopes;

$client = new Client(array(
    'client_id'     => $client_id,
    'client_secret' => $client_secret,
    'username'      => $test_username,
    'password'      => $test_password,
    'scope'         => Scopes::SCOPE_TRUST,
));

try {
    $tokens = $client->getAccessToken();
} catch (ClientException $ex) {
    echo "An error happend while trying to retrieve your tokens\n";
    echo "Reason : ".$ex->getMessage()."\n";
    die();
}

try {
    $helper = new Helper($client);
    $measurements = $helper->measurements('10 minute ago');
    $measurements = $helper->normalize($measurements);
} catch (ClientException $ex) {
    echo "An error happend while trying to retrieve your last measures\n";
    echo $ex->getMessage()."\n";
}

?>
<html>
<body>
    <pre>
        <code>
<?= Formatter::prettyJson($measurements)?>
        </code>
    </pre>
</body>
</html>
