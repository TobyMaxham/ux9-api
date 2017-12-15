<?php

namespace TobyMaxham\Ux9;

/**
 * Class Shortener
 * @package TobyMaxham\Ux9
 * @author Tobias Maxham
 */
class Shortener
{
    private $url = [];
    private $response;

    // API URL
    protected $endPoint = 'https://api.ux9.de/';
    protected $version = 'v2';

    // API Options
    private $token;
    private $format;
    private $alias;
    private $password;
    private $expire;
    private $limit;

    /**
     * @return string
     */
    protected function getApiUrl()
    {
        $endpoint = $this->endPoint . $this->version;
        return $endpoint ;
    }

    /**
     * @param null|string $url
     * @param null|string $config
     * @param bool|string $format
     */
    public function __construct($url = null, $config = null, $format = 'json')
    {
        $this->addUrl($url);
        if (!empty($config)) {
            extract($config);
        }

        if (isset($API_TOKEN)) {
            $this->setToken($API_TOKEN);
        }

        if (isset($FORMAT)) {
            $this->format($FORMAT);
        } else {
            $this->format($format);
        }
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param string $url
     */
    public function addUrl($url)
    {
        if (is_array($url)) {
            $this->url = array_merge($this->url, $url);
        } else {
            $this->url[] = $url;
        }
    }

    /**
     * @param string $format
     */
    public function format($format)
    {
        $this->format = $format;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @param string $url
     * @return mixed
     */
    public function short($url)
    {
        unset($this->url);
        $this->addUrl($url);
        $req = $this->out();

        if ($this->getFormat() == 'json' || $this->getFormat() == 'array') {
            return $req;
        }

        $return = isset($req['link']) ? $req['link'] : null;
        $this->url = [];
        $this->response = null;
        return $return;
    }

    /**
     * @return mixed
     */
    public function out()
    {
        if (is_null($this->response)) {
            $this->call();
        }
        return $this->parseResponse();
    }

    /**
     * @return $this
     */
    public function call()
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->getApiUrl() . '?' . http_build_query($this->getOptions()),
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 4,

        ]);
        $this->response = curl_exec($ch);
        curl_close($ch);

        return $this;
    }

    /**
     * @return array $options
     */
    private function getOptions()
    {
        $required = [
            'token' => $this->getToken(),
            'url' => $this->getUrl()[0],
        ];

        $optional = [];
        if (null != $this->alias) {
            $optional['key'] = $this->getAlias();
        }
        if (null != $this->format) {
            $optional['format'] = $this->getFormat();
        }
        if (null != $this->password) {
            $optional['password'] = $this->getPassword();
        }
        if (null != $this->limit) {
            $optional['limit'] = $this->getLimit();
        }
        if (null != $this->expire) {
            $optional['expire'] = $this->getExpire();
        }

        return array_merge($required, $optional);
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getToken()
    {
        if (null == $this->token) {
            throw new Exception('The token is required!');
        }
        return $this->token;
    }

    /**
     * @return array
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return bool|string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return mixed
     */
    private function parseResponse()
    {
        $res = new Responder($this->response);
        return $res->get($this->getFormat());
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }
}
