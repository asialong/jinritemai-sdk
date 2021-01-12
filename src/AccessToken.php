<?php
namespace Asialong\JinritemaiSdk;

use Hanson\Foundation\AbstractAccessToken;

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

    public function __construct($clientId, $secret, $serviceId)
    {
        $this->appId = $clientId;
        $this->secret = $secret;
        $this->serviceId = $serviceId;
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
     * 检测是否有错误信息    todo 错误处理
     * @param $result
     * @return bool|mixed
     * @throws \Exception
     */
    public function checkTokenResponse($result)
    {
        if (isset($result['err_no']) && (0 != $result['err_no'])) {
            throw new \Exception('这里要改', 520);
            throw new \Exception($result['error_response']['error_msg'], $result['error_response']['code']);
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