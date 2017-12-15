<?php

namespace TobyMaxham\Ux9;

/**
 * Class Responder
 * @package TobyMaxham\Ux9
 * @author Tobias Maxham
 */
class Responder
{

    /**
     * Responder constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
        if ($e = $this->hasError()) {
            throw new \Exception($e);
        }
    }

    /**
     * @return bool
     */
    private function hasError()
    {
        $data = json_decode($this->response, true);
        if ($data['error'] > 0) {
            return $data['msg'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->response;
    }

    /**
     * @param string $format
     * @return mixed
     */
    public function get($format)
    {
        if ($format == 'plain') {
            return $this->makePlain();
        }
        if ($format == 'json') {
            return $this->makeJson();
        }
        return json_decode($this->response, true);
    }

    /**
     * @return string
     */
    private function makePlain()
    {
        $data = json_decode($this->response, true);
        return $data['link'];
    }

    /**
     * @return mixed
     */
    private function makeJson()
    {
        return $this->response;
    }
}
