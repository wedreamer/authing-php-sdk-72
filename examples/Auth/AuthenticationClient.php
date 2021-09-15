<?php
// declare(strict_types=1);

use Authing\Auth\AuthenticationClient;

require_once __DIR__ . '../../../vendor/autoload.php';

$authentication = new AuthenticationClient(function ($opts) {
    $opts->appId = "6116252a007c0a175af1636c";
});

var_dump($authentication->options);

$obj = $authentication->loginByEmail("lixintao2@authing.cn", "lixintao2@authing.cn");

try {
    var_dump($obj->token);
    $res = $authentication->validateToken(['accessToken' => $obj->token]);

    
    var_dump($res);
} catch (\Throwable $throwable) {
    echo $throwable;
}