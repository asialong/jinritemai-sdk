<?php
namespace Asialong\JinritemaiSdk;

use Hanson\Foundation\Foundation;

/**
 * Class Doudian
 * @package Asialong\JinritemaiSdk
 *
 * @property \Asialong\JinritemaiSdk\Api           $api
 * @property \Asialong\JinritemaiSdk\Api           $auth_api
 * @property \Asialong\JinritemaiSdk\AccessToken   $access_token
 * @property \Asialong\JinritemaiSdk\Oauth\PreAuth $pre_auth
 * @property \Asialong\JinritemaiSdk\Oauth\Oauth   $oauth
 * @property \Asialong\JinritemaiSdk\Test         $test
 *
 */
class Doudian extends Foundation
{
    protected $providers = [
        ServiceProvider::class,
        Oauth\ServiceProvider::class,
        TestServiceProvider::class
    ];
}