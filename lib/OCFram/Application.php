<?php
namespace OCFrams;


 abstract class Application
{
  protected $httpRequest;
 
 
  public function __construct()
  {
    $this->httpRequest = new HTTPRequest($this);
    
  }
 
  abstract public function run();
 
  public function httpRequest()
  {
    return $this->httpRequest;
  }
 
}