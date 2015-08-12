<?php

namespace TobyMaxham;

class Shortener
{
   
   private $url = [];
   private $format;

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
}
