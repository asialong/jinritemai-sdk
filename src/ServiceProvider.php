<?php
namespace Asialong\JinritemaiSdk;

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
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['access_token'] = function (Foundation $pimple) {
            return new AccessToken(
                $pimple->getConfig('client_id'),
                $pimple->getConfig('client_secret'),
                $pimple->getConfig('service_id'),
                new Http($pimple),
                $pimple->getConfig('is_self_used'),
            );
        };

        $pimple['api'] = function ($pimple) {
            return new Api($pimple);
        };
        $pimple['auth_api'] = function ($pimple) {
            return new Api($pimple, true);
        };
    }
}