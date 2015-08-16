<?php

namespace TobyMaxham;

/**
 * Class Responder
 * @package TobyMaxham
 * @author Tobias Maxham
 */
class Responder
{

	public function __construct($response)
	{
		$this->response = $response;
		if ($e = $this->hasError()) throw new \Exception($e);
	}

	private function hasError()
	{
		$data = json_decode($this->response, TRUE);
		if ($data['error'] > 0) return $data['msg'];
		return FALSE;
	}

	public function __toString()
	{
		return $this->response;
	}

	public function get($format)
	{
		if ($format == 'plain') return $this->makePlain();
		if ($format == 'json') return $this->makeJson();
		return json_decode($this->response, TRUE);
	}

	private function makePlain()
	{
		$data = json_decode($this->response, TRUE);
		return $data['link'];
	}

	private function makeJson()
	{
		return $this->response;
	}

} 