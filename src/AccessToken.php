<?php
namespace Asialong\JinritemaiSdk;

use Hanson\Foundation\AbstractAccessToken;
use Hanson\Foundation\Foundation;

class AccessToken extends AbstractAccessToken
{
    const TOKEN_API = 'https://openapi-sandbox.jinritemai.com/oauth2/access_token';
    protected $code;
    protected $serviceId;

    /**
     * key of token in json.
     *
     * @var string
     */
    protected $tokenJsonKey = 'access_token';

    /**
     * key of expires in json.
     *
     * @var string
     */
    protected $expiresJsonKey = 'expires_in';

    public function __construct(array $appParams, $http)
    {
        $this->appId = $appParams['client_id'];
        $this->secret = $appParams['client_secret'];
        $this->serviceId = $appParams['service_id'];
        $this->setHttp($http);
    }

    /**
     * 使用code从服务器获取token
     * @return mixed
     * @throws \Exception
     */
    public function getTokenFromServer()
    {
        if (!empty($_GET['code'])) {
            $this->setCode(trim($_GET['code']));
        }
        if (empty($this->code)) {
            throw new \Exception('code不能为空');
        }
        $response = $this->getHttp()->json(self::TOKEN_API, [
            'app_id'     => $this->appId,
            'app_secret' => $this->secret,
            'grant_type'    => 'authorization_code',
            'code'          => $this->code,
        ]);

        return json_decode(strval($response->getBody()), true);
    }

    /**
     * 检测是否有错误信息
     * @param $result
     * @return bool|mixed
     * @throws \Exception
     */
    public function checkTokenResponse($result)
    {
        if (isset($result['err_no']) && (0 != $result['err_no'])) {
            throw new JinritemaiSdkException($result['message'], $result['err_no']);
        }

        return true;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return integer
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @param mixed $code
     *
     * @return AccessToken
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

}