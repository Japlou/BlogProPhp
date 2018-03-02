<?php

namespace lib\vendors\Entity;



/**
 * Une classe representent un Post.
 */

class Post
{

	protected $id, $titre, $auteur, $chapo, $contenu, $dateCreation, $dateModification;
	
	
	//GETTERS //
	
	public function  getid()
	{
		return $this->id;
	}
	public function getAuteur()
	{
		return $this->auteur;
	}
	public function getTitre()
	{
		return $this->titre;
	}
	public function getChapo()
	{
		return $this->chapo;
	}
	public function getContenu()
	{
		return $this->contenu;
	}
	public function getDateModification()
	{
		return $this->dateModification;
	}
	public function getDateCreation()
	{
		return $this->dateCreation;
	}

	// SETTERS //
	
	public function setId($id)
	{
		$this->id = (string) $id;		
	}

	public function setTitre($titre)
	{		
		$this->titre = (string) $titre;	
	}

	public function setChapo($chapo)
	{
		$this->chapo = (string) $chapo;	
	}

	public function setContenu($contenu)
	{	
		$this->contenu = (string) $contenu;
	}

	public function setAuteur($auteur)
	{
		$this->auteur = (string) $auteur;
	}

	public function setDateModification($dateModification)
	{
		$this->dateModification = $dateModification;
	}

	public function setDateCreation($dateCreation)
	{
		$this->dateCreation = $dateCreation;
	}

}