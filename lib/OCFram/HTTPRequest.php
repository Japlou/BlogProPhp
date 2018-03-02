<?php

namespace OCFrams;

/**
 * class Request
 * @package App
 */
class HTTPRequest extends ApplicationComponent
{
  
    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getData($key)
    {
      
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public function postData($key)
    {  
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }
   
    public function cookieData($key)
    {
      return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }
   
    public function cookieExists($key)
    {
      return isset($_COOKIE[$key]);
    }
    public function getEnv($key)
    {
        return getenv($key);
    }

    
}