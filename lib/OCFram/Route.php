<?php 

namespace OCFrams;

/**
* 
*/
class Route
{
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $path;
	/**
	 * @var array
	 */
	private $params = [];
	/**
	 * @var string
	 */
	private $controller;
	/**
	 * @var string
	 */
	private $action;
	/**
	 * @var array
	 */
	private $matches = [];

	/**
	 * Route constructor
	 * @param [string] $name      
	 * @param [string] $path    
	 * @param [array] $param      
	 * @param [string] $controller 
	 * @param [string] $action     
	 */
	function __construct($name, $path, $params, $controller, $action)
	{
		$this->name = $name;
		$this->path = $path;
		$this->params = $params;
		$this->controller = $controller;
		$this->action = $action;	
	}

	/** 
	 * @param  Request  $request  
	 * @param  Database $database 
	 * @return Response            
	 */
	public function call(HTTPRequest $request, Database $database)
	{


		$controller = $this->controller;
		$controller = new $controller($request, $database);
		if (isset($this->matches[1])) {
			return call_user_func_array([$controller, $this->action], [$request, $this->matches[1]]);
		}else{
			return call_user_func_array([$controller, $this->action], [$request]);
		}	
	}
	/**
	 * @param  $uri
	 * @return bool    
	 */
	public function match($uri)
	{
		
		$uri = trim($uri,"/");
		$path = preg_replace_callback("#:([\w]+)#", [$this, "paramMatch"], $this->path);
		$regex = "#^$path$#i";

		if (!preg_match($regex, $uri, $matches)) {

			return false;
		}
		array_slice($matches, 1);
		$this->matches = $matches;
		return true;
	}

	/**
	 * @param $match
	 * @return String
	 */
	public function paramMatch($match)
	{
		if(!isset($this->params[$match[0]])){
			return "(" . $this->params[$match[1]] . ")";
		}
		return "([^/]+)";
	}
//GETTER

	/**
	 * @return String 
	 */
	public function getName()
	{
		return $this->name;
	}
	/**
	 * @return  String
	 */
	
	public function getPath()
	{
		return $this->path;
	}
	/**
	 * @return String
	 */
	public function getParams()
	{
		return $this->params;
	}
	/**
	 * @return String
	 */
	public function getController()
	{
		return $this->controller;
	}
	/**
	 * @return String
	 */
	public function getAction()
	{
		return $this->action;
	}

//SETTER
	/**
	 * setName 
	 * @param String $nane 
	 */
	public function setName($nane){

		$this->name = $name;
	}
	/**
	 * setPath 
	 * @param String $path 
	 */
	public function setPath($path){

		$this->path = $path;
	}
	/**
	 * setParams 
	 * @param String $params 
	 */
	public function setParams($params){

		$this->params = $params;

	}
	/**
	 * setController 
	 * @param String $controller
	 */
	public function setController($controller){

		$this->controller = $controller;
	}
	/**
	 * setAction 
	 * @param String $action
	 */
	public function setAction($action){

		$this->action = $action;

	}
	
}