<?php

namespace App\Frontend\Controller;

use OCFrams\BackController;
use lib\vendors\Entity\Post;
use OCFrams\Database;
use OCFrams\HTTPResponse;
use OCFrams\HTTPRequest;
use lib\vendors\Model\PostManager;



class PostController extends BackController
{
	
	/**
	 * [createAction Methode de la fonction cree un post]
	 * @param $query [recuperation des infomations relatif a la function insert du fichier PostManager.php.]
	 */
	public function createAction(HTTPRequest $request)
	{	
		if ($request->postData('titre') && $request->postData('auteur') && $request->postData('chapo') && $request->postData('contenu'))
		{
			$query = $this->db->insert(
			[ 
				'titre' => $request->postData('titre'),
				'auteur' => $request->postData('auteur'),
				'chapo' => $request->postData('chapo'),
				'contenu' => $request->postData('contenu')
			]);
			//va chercher l'id correspondent de la method max de la class PostManager
			$id = $this->db->max();
			//va chercher les informations de la methode displayAction afin d'afficher l'article suivent son ID.
			$this->displayAction($request, $id);
		}else {
			
        	echo $this->twig->render('Views/create.html.twig');
		}
	}

	/**
	 * [diplayAction Methode qui affiche un post]
	 * @param $post [recuperation les infomations relatif à la function Show du fichier PostManager.php]
	 */
	public function displayAction(HTTPRequest $request)
	{
		$id = $request->getData('id');
		$post = $this->db->display(
		[
			'id' => $id 
		]);
		echo $this->twig->render('Views/show.html.twig',
        [
			//Va charger les fonctions get de la class Post.php
            "id" => $post->getid(),
            "titre" => $post->getTitre(),
            "chapo" => $post->getChapo(),
            "auteur" => $post->getAuteur(),
            "dateCreation" => $post->getDateCreation(),
            "dateModification" => $post->getDateModification(),
            "contenu" => $post->getContenu()
        ]
		);		
	}

	/**
	 * [validationAction Method de la fonction show
	 * @param $post [va chercher l'ID du post et l'affiche le post afin de valité ou non la suppression du post de la bdd ]
	 */
	public function validationAction(HTTPRequest $request)
	{	
		//utilise la method getData de la class HTTPRequest.
		$id = $request->getData('id');
		//appelle ID de la methode show de la class postManager
		$post = $this->db->show(
		[
			'id' => $id 
		]);
        echo $this->twig->render('Views/delete.html.twig',
         [
        	//Va charger les fonctions get de la class Post.php et affiche l'article.
            "id" => $post->getid(),
            "titre" => $post->getTitre(),
            "chapo" => $post->getChapo(),
            "auteur" => $post->getAuteur(),
            "contenu" => $post->getContenu()
        ]
        );        
	}
	
	/**
	 * [deleteAction Supprime le post de la BDD.]
	 * @var $id [recupére les paramétres de la method getData de la class HTTPRequest]
	 * @param $query [récupération des informations relatif à la fonction delete du fichier PostManager.php.
	 */
	public function deleteAction(HTTPRequest $request)
	{
		$id = $request->getData('id');
		$query = $this->db->delete(
		[
			'id' => $id
		]);
		header('Location:../posts');
	}

	/**
	 * [listAction Methode de la fonction list des posts]
	 * @return $list [recuperation des infomations relatif a la function select du fichier PostManager.php.]
	 */
	public function listAction(HTTPRequest $request)
	{
		//Appelle la methode select de la class postManager.
		$list = $this->db->select();
		//Affiche la liste des articles.
		echo $this->twig->render('Views/listPost.html.twig',
		[
			"list" => $list
		]);
	}

	/**
	 * [showAction description]
	 * @param $query [recuperation des infomations relatif à la function Show du fichier PostManager.php.]
	 */
	public function showAction(HTTPRequest $request)
	{
		$id = $request->getData('id');
		$post = $this->db->show(
		[
			'id' => $id 
		]);
        echo $this->twig->render('Views/show.html.twig',
        [
			//Va charger les fonctions get de la class Post.php
            "id" => $post->getid(),
            "titre" => $post->getTitre(),
            "chapo" => $post->getChapo(),
            "auteur" => $post->getAuteur(),
            "dateCreation" => $post->getDateCreation(),
            "dateModification" => $post->getDateModification(),
            "contenu" => $post->getContenu()
        ]);		
	}

	/**
	 * [updateAction Methode de la fonction update du post]
	 * @param $query [recuperation des infomations relatif à la function Show du fichier PostManager.php.]
	 * @param $query [recuperation des infomations relatif à la function Update du fichier PostManager.php.]
	 */
	public function updateAction(HTTPRequest $request)
	{
		$id = $request->getData('id');
		if ($request->postData('titre') && $request->postData('auteur') && $request->postData('chapo') && $request->postData('contenu'))
		{
			$query = $this->db->update(
			[ // parametre $_POST.
				'id' => $id,
				'titre' => $request->postData('titre'),
				'auteur' => $request->postData('auteur'),
				'chapo' => $request->postData('chapo'),
				'contenu' => $request->postData('contenu')

			]);
			$this->showAction($request);
		}else {
			$post = $this->db->show(
			[
				'id' => $id 
			]);
        	echo $this->twig->render('Views/modifPost.html.twig',
            [
            	//Va charger les fonctions get de la class Post.php
                "id" => $post->getid(),
                "titre" => $post->getTitre(),
                "chapo" => $post->getChapo(),
                "auteur" => $post->getAuteur(),
                "dateCreation" => $post->getDateCreation(),
                "dateModification" => $post->getDateModification(),
                "contenu" => $post->getContenu()
            ]);
		}
	}	
}