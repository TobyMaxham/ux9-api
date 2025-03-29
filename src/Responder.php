<?php

namespace TobyMaxham\Ux9;

/**
 * @author Tobias Maxham <git@maxham.de>
 */
class Responder
{
    protected $response;

    /**
     * @throws \Exception
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
     * @param  string  $format
     * @return mixed
     */
    public function get($format)
    {
        if ('plain' == $format || 'string' == $format) {
            return $this->makePlain();
        }
        if ('json' == $format) {
            return $this->makeJson();
        }

        return json_decode($this->response, true);
    }

    /**
     * @return string
     */
    private function makePlain()
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    private function makeJson()
    {
        return $this->response;
    }
}
