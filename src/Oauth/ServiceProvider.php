<?php
namespace Asialong\JinritemaiSdk\Oauth;

use Hanson\Foundation\Foundation;
use Hanson\Foundation\Http;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['oauth.access_token'] = function (Foundation $pimple) {
            $accessToken = new AccessToken(
                $pimple->getConfig('client_id'),
                $pimple->getConfig('client_secret'),
                $pimple->getConfig('service_id'),
                new Http($pimple),
                $pimple->getConfig('is_self_used'),
            );

            $accessToken->setRequest($pimple['request']);

            $accessToken->setRedirectUri($pimple->getConfig('redirect_uri'));

            return $accessToken;
        };

        $pimple['pre_auth'] = function ($pimple) {
            return new PreAuth($pimple);
        };

        $pimple['oauth'] = function ($pimple) {
            return new Oauth($pimple);
        };
    }
}