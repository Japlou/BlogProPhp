<?php

namespace OCFrams;


use OCFrams\ApplicationComponent;
use OCFrams\page;
use lib\vendors\Model\PostManager;
use APP\Frontend\Controller\PostController;
use OCFrams\Instance_db;
use OCFrams\Databasse;



/**
 * @package OCFrams
 */
class BackController extends ApplicationComponent
{
  /**
   * @var \Twig_Environement
   */
  protected $twig;
  protected $db;
  protected $param_db;
  protected $action = '';
  protected $controller = '';
  protected $page = null;
  protected $view = '';
  protected $managers = null;
 
 
	public function __construct( Application $app, $controller, $action)
	{
    
		/**
		 * [$loader  Appelle de Twig_Loader_Filesystem ]
		 * [appelle du twig_environnement, on parametre les caches a false]
		 * configuration de twig.
		 */
    $loader = new \Twig_Loader_Filesystem('../App/Frontend/Templates/');
    $this->twig = new \Twig_Environment($loader, array('cache' => false,));

    /*$param_db = \OCFrams\Instance_db::getInstance();
    $this->db = new PostManager($param_db->get('db_name'), $param_db->get('db_user'), $param_db->get('db_pass'), $param_db->get('db_host'));
    */
    $param_db = \OCFrams\Instance_db::getInstance();
		$this->db = new PostManager($param_db->get('db_name'), $param_db->get('db_user'), $param_db->get('db_pass'), $param_db->get('db_host'));
    parent::__construct($app);
    $this->page = new Page($app);

 
    $this->setController($controller);
    $this->setAction($action);
    $this->setView($action);
 
    }
   
    public function execute()
  {
    //is_callable vérifie la variable: Si TRUE la variable $action est appelable, FALSE renvois \RuntimeException
    if (!is_callable([$this, $this->action]))
    {
      throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie sur ce module');
    }
    //appelle l'action du controller.
    $this->{$this->action}($this->app->httpRequest()); 
    
  }

  public function page()
  {
    return $this->page;
  }
 
  public function setController($controller)
  {
    /**
     * is_string : détermine si la variable $controller est d'une chaine de caractères
     * empty détermine si la variable et vide ou non.
     */
    if (!is_string($controller) || empty($controller))
    {
      throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
    }
    $this->controller = $controller;
  }
 
  public function setAction($action)
  {
    if (!is_string($action) || empty($action))
    {
      throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
    }
    $this->action = $action;
  }
 
  public function setView($view)
  {
    
    if (!is_string($view) || empty($view))
    {
      throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
    }
 
    $this->view = $view;
    
    //
    $this->page->setContentFile(__DIR__.'/../../App/'.$this->app->name().'/Controller/'.$this->controller.'/Views/'.$this->view.'.html.twig');
  }


}
