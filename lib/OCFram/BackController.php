<?php

namespace OCFrams;

use Models\PostManager;
use OCFrams\Instance_db;
use OCFrams\Databasse;

/**
 * @package OCFrams
 */
class BackController
{
  /**
   * @var \Twig_Environement
   */
	protected $twig;
  /**
   * @var HTTPRequest
   */
  protected $request;
  /**
   * @var Database
   */
  protected $db;
  protected $param_db;
  private $database;
 
	public function __construct(HTTPRequest $request, Database $database)
	{
    $this->HTTPRequest = $request;
    $this->database = $database;

		/**
		 * [$loader  Appelle de Twig_Loader_Filesystem ]
		 * [appelle du twig_environnement, on parametre les caches a false]
		 * configuration de twig.
		 */
    $loader = new \Twig_Loader_Filesystem('../App/Frontend/Resources/Views/Templates/');
    $this->twig = new \Twig_Environment($loader, array('cache' => false,));

    $param_db = \OCFrams\Instance_db::getInstance();
    $this->db = new PostManager($param_db->get('db_name'), $param_db->get('db_user'), $param_db->get('db_pass'), $param_db->get('db_host'));

    }
    
    /**
     * @return Databasse
     */
     public function getDatabase()
    {
        return $this->database;
    }


}
