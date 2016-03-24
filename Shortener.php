<?php

namespace TobyMaxham\Ux9;

/**
 * Class Shortener
 * @package TobyMaxham\Ux9
 * @author Tobias Maxham
 */
class Shortener
{

	private $alias = FALSE;
	private $token;
	private $url = [];
	private $format;
	private $response;

	/**
	 * @param null|string $url
	 * @param bool|string $format
	 * @param null|string $config
	 */
	public function __construct($url = NULL, $format = FALSE, $config = NULL)
	{
		$this->addUrl($url);
		if(!empty($config))	extract($config);

		if(isset($API_TOKEN)) $this->setToken($API_TOKEN);
		elseif (isset($TOKEN)) $this->setToken($TOKEN);

		if(isset($FORMAT)) $this->format($FORMAT);
		elseif (isset($format)) $this->format($format);
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
		if (is_array($url))
			$this->url = array_merge($this->url, $url);
		else
			$this->url[] = $url;
	}

	/**
	 * @param string $format
	 */
	public function format($format)
	{
		$this->format = $format;
	}

	/**
	 * @param string $url
	 * @return mixed
	 */
	public function short($url)
	{
        unset($this->url);
        $this->addUrl($url);
        $req = $this->out($this->getFormat());

        if($this->getFormat() == 'json' || $this->getFormat() == 'array')
            return $req;

        $return = isset($req['link']) ? $req['link'] : NULL;
        $this->url = [];
        $this->response = NULL;
        return $return;
	}

	/**
	 * @param null|string $format
	 * @return mixed
	 */
	public function out($format = NULL)
	{
		if (!is_null($format)) $this->format($format);
		if (is_null($this->response)) $this->call();
		return $this->parseResponse();
	}

	/**
	 * @return $this
	 */
	public function call()
	{
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => 'http://api.ux9.de/?' . http_build_query($this->getOptions()),
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => TRUE,
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
		return [
			'token' => $this->getToken(),
			'url' => $this->getUrl()[0],
			'alias' => $this->getAlias(),
			//'format' => $this->getFormat(),
		];
	}

	/**
	 * @return string
	 */
	public function getToken()
	{
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
