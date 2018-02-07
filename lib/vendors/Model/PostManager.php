<?php 

namespace Models;

use OCFrams\Database;
use Entitys\Post;
use \PDO;


class PostManager extends Database
{

	/**
	 * [select Liste de tout les Posts]
	 * @param  $query [chargement d'une requete SELECT]
	 * @return $data [retourne le jeu de résultats sous forme d'un objet dont les noms de propriétés correspondent aux noms des colonnes]
	 */
	public function select()
	{ 
		
		$query = $this->getPDO()->query('SELECT id, titre, chapo, auteur, DATE_FORMAT(dateCreation, \'%d/%m/%Y a %Hh%i\') AS dateCreation, DATE_FORMAT(dateModification, \'%d/%m/%Y a %Hh%i\') AS dateModification, contenu FROM post ORDER BY id DESC');
		// Récupère la prochaine ligne et la retourne en tant qu'objet
		$data = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
		return $data; //retourne la valeur de la variable $data.
		
	}

	/**
	 * [show Affiche un post specifique en fonction de son identifiant (id)]
	 * @param  $attributes [recupere les infos de la requete select]
	 * @param  $query [execute la requete preparer getPDO]
	 * @return $data  [Retourne un tableau contenant toutes les lignes du jeu d'enregistrements]
	 */
	public function show($attributes)
	{
		//Chargement d'une requete preparer SELECT 
		$query = $this->getPDO()->prepare('SELECT id, titre, chapo, auteur, DATE_FORMAT(dateCreation, \'%d/%m/%Y a %Hh%i\') AS dateCreation, DATE_FORMAT(dateModification, \'%d/%m/%Y a %Hh%i\') AS dateModification, contenu FROM post WHERE id = :id');
		$query->execute($attributes);
		$data = $query->fetchObject(Post::class);
		return $data;
	}

	/**
	 * [insert Insert le Post dans la BDD]
	 * @param  $attributes [execute la requete preparer getPDO]
	 * @return $query      [chargement d'une requete preparer INSERT]
	 */
	public function insert($attributes)
	{  
		$query = $this->getPDO()->prepare('INSERT INTO post (titre, auteur, chapo, contenu, dateCreation, dateModification) VALUES (:titre, :auteur, :chapo, :contenu, now(), now())');
		$query->execute($attributes);
		return $query;
	}

	/**
	 * [update Met à jour un post en fonction de son identifiant (ID).]
	 * @param  $attributes [execute la requete preparer getPDO]
	 * @return $query      [Chargement d'une requete preparer UPDATE]
	 */
	public function update($attributes)
	{
		
		$query = $this->getPDO()->prepare('UPDATE post SET titre = :titre, auteur = :auteur, chapo = :chapo, dateModification = now(), contenu = :contenu WHERE id = :id');
		$query->execute($attributes);
		return $query;
	}

	/**
	 * [max // Recupere le dernier identifiant de la table.]
	 * @param  $query [Chargement d'une requete SELECT]
	 * @return $data  [retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats]
	 */
	public function max()
	{
		$query = $this->getPDO()->query('SELECT MAX(id) FROM post');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		return $data;
	}

	/**
	 * [delete Supprime un Post de la BDD en fonction de son ID]
	 * @param  $query [Chargement d'une requete preparer DELETE]
	 * @param  $attributes [execute la requete preparer getPDO]
	 * @return $query      [Chargement d'une requete preparer DELETE]
	 */
	public function delete($attributes)
	{
	
		$query = $this->getPDO()->prepare('DELETE FROM post WHERE id = :id');
		$query->execute($attributes);
		return $query;
		
	}
}