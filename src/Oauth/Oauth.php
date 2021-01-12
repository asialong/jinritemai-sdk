<?php
namespace Asialong\JinritemaiSdk\Oauth;

use Asialong\JinritemaiSdk\Doudian;

class Oauth
{
    /**
     * @var Doudian
     */
    private $app;

    public function __construct(Doudian $app)
    {
        $this->app = $app;
    }

    public function createAuthorization($token, $expires = 86399)
    {
        $accessToken = new AccessToken(
            $this->app->getConfig('client_id'),
            $this->app->getConfig('client_secret')
        );

        $accessToken->setToken($token, $expires);

        $this->app->access_token = $accessToken;

        return $this->app;
    }
}