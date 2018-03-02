<?php

namespace OCFrams;

class Instance_db
{
	private $donnees = [];
	
	private static $_instance; // Contientras l'instance de la class.

   /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    * @return   [<S'assure que c'est un singletron donc la class Instance_db est seulement instancié une fois>]
    */
  public static function getInstance()
   {

   	if (is_null(self::$_instance)) 
    {
   		self::$_instance = new Instance_db();
   	}
   	return self::$_instance;
   }

   /**
    * Constructeur de la classe
    * Va charger le fichier Connexion_db.php.
    */
   
  public function __construct()
   {
   	$this->donnees = require dirname(dirname(__DIR__)) . '\App\Frontend\Config_db\Connexion_db.php';
   }

   /**
    * Apporte les infos relatif au fichier Connexion_db.php.
    * @param $key string clef à récupérer
    * @return mixed
    */

  public function get($key)
  {
    
    if(!isset($this->donnees[$key]))
    {
      return null;
    }
    return $this->donnees[$key];
  } 
}