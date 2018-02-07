<?php


namespace OCFrams;

use \PDO;
use Models\PostManager;
use Entitys\Post;

/**
 * class Database
 * @package  OCFrams
 */
class Database 
{
	/**
	 * @var String
	 */
	private $db_name;
	/**
	 * @var String
	 */
	private $db_user;
	/**
	 * @var String
	 */
	private $db_pass;
	/**
	 * @var String
	 */
	private $db_host;
	/**
	 * @var \PDO
	 */
	private $pdo;

	public function newInstance(HTTPRequest $request)
	{
		return new Database($request);

	}


	/**
	 * [__construct va recuperer les informations de la methode getPDO]
	 * @param [type] $db_name [Va chercher les informations db_name de la class Connexion_db]
	 * @param string $db_user [Va chercher les informations db_user de la class Connexion_db]
	 * @param string $db_pass [Va chercher les informations db_pass de la class Connexion_db]
	 * @param string $db_host [Va chercher les informations db_host de la class Connexion_db]
	 */
	public function __construct ($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost')
	{
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}

	/**
	 * @method [return $pdo] [getPDO] [Connexion a la BDD en utilisant PDO]
	 */
	
	public function getPDO() {
		if($this->pdo === null) { // s'assure que la BDD est pas deja connectee.
			$pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host . '', '' . $this->db_user . '', '' . $this->db_pass . '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}

	public function getManager($model)
	{
		return new PostManager($this, $model);
	}

}

