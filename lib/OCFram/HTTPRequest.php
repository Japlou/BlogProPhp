<?php

namespace OCFrams;

use OCFrams\ApplicationComponent;

/**
 * class Request
 * @package App
 */
class HTTPRequest extends ApplicationComponent
{

    /**
     * @var array
     */
    private $server;

    /**
     * @var array
     */
    private $get;

    /**
     * @var array
     */
    private $post;

    /**
     * @var array
     */
    private $files;

    /**
     * @var array
     */
    private $cookie;

    /**
     * @var array
     */
    private $session;

    /**
     * @var array
     */
    protected $request;

    /**
     * Create an instance of Request
     * @return Request
     */
    
    public function __construct()
    {
       
    }

   public static function createFromGlobals()
    {
        session_start();
        $request = new HTTPRequest;
        $request->setServer($_SERVER);
        $request->setGet($_GET);
        $request->postData(isset($_POST['']) ? $_POST[''] : null);
        $request->getData(isset($_GET['']));
        $request->setFiles($_FILES);
        $request->setCookie($_COOKIE);
        $request->setSession($_SESSION);
        $request->setRequest($_REQUEST);
        return $request;
    }

    /**
     *  @return mixed
     */
    public function getUri()
    {
        return $this->server["REQUEST_URI"];
    }

    /**
     * @return array
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param array $server
     */
    public function setServer($server)
    {
        $this->server = $server;
    }

    /**
     * @return array
     */

    public function getGet()
    {

        return $this->get;
    }

    /**
     * @param array $get
     */
    public function setGet($get)
    {

        $this->get = $get;
    }

    /**
     * [getData return les information $_GET
     * @param  array $key 
     * @return 
     */
    public function getData($key)
    {

        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

   /**
    * [postData return les informations $_POST 
    * @param  array $key 
    * @return 
    */
    public function postData($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    /**
     * @return array
     */
    public function getFiles()
    {

        return $this->files;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return array
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param array $cookie
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * @return array
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param array $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param array $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function getEnv($key)
    {

        return getenv($key);
    }

}