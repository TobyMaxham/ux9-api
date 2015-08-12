<?php

namespace TobyMaxham;

class Shortener
{
   
   private $url = [];
   private $format;
   private $response;

   public function _construct($url = NULL, $format = 'json')
   {
      $this->addUrl($url);
      $this->format($format);
   }

   public function addUrl($url)
   {
      if(is_array($url))
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
      if(!is_null($format)) $this->format($format);
      if(is_null($this->response)) $this->call();
      return $this->parseResponse();
   }

   private function parseResponse()
   {
      if($this->format == 'plain') return $this->response;
      $data = json_encode($this->response);
      return new Responder($data);
   }
}
