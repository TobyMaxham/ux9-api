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

	public function __construct($url = NULL, $format = FALSE)
	{
		$this->addUrl($url);

		if (file_exists(__DIR__ . '/config.php')) {
			$cfg = include __DIR__ . '/config.php';
			if (isset($cfg['API_TOKEN']))
				$this->token = $cfg['API_TOKEN'];

			if (!$format && isset($cfg['FORMAT']))
				$format = $cfg['FORMAT'];
			else $format = 'json';
		}
		$this->format($format);
	}

	public function addUrl($url)
	{
		if (is_array($url))
			$this->url = array_merge($this->url, $url);
		else
			$this->url[] = $url;
	}

	public function format($format)
	{
		$this->format = $format;
	}

	public function out($format = NULL)
	{
		if (!is_null($format)) $this->format($format);
		if (is_null($this->response)) $this->call();
		return $this->parseResponse();
	}

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

	private function getOptions()
	{
		return [
			'token' => $this->getToken(),
			'url' => $this->getUrl()[0],
			'alias' => $this->getAlias(),
			//'format' => $this->getFormat(),
		];
	}

	public function getToken()
	{
		return $this->token;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getAlias()
	{
		return $this->alias;
	}

	private function parseResponse()
	{
		$res = new Responder($this->response);
		return $res->get($this->getFormat());
	}

	public function getFormat()
	{
		return $this->format;
	}
}
