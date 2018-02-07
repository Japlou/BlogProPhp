<?php

namespace Controllers;

use OCFrams\BackController;
use Entitys\Post;
use OCFrams\Database;
use OCFrams\HTTPResponse;
use OCFrams\HTTPRequest;
use Models\PostManager;



class PostController extends BackController
{
	
	/**
	 * [createAction Methode de la fonction cree un post]
	 * @param $query [recuperation des infomations relatif a la function insert du fichier PostManager.php.]
	 */
	public function createAction($request)
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
				$id = $this->db->max();
				$this->showAction($request, $id['MAX(id)']);
		}else {

			echo $this->twig->render('post/create.html.twig');
		}	
	}
	
	/**
	 * [deleteAction Methode de la fonction Delete.]
	 * @param $id [recuperation des infomations relatif a la function delete du fichier PostManager.php. 
	 */
	public function deleteAction($request, $id)
	{
		
		
			$query = $this->db->delete([
				'id' => $id
			]);
			header('Location:../posts');
		
        
	}

	public function validationAction($request, $id)
	{
		
			$post = $this->db->show(
				[
					'id' => $id 
				]);

        	echo $this->twig->render('post/delete.html.twig',
            	[
            		//Va charger les fonctions get de la class Post.php
                	"id" => $post->getid(),
                	"titre" => $post->getTitre(),
                	"chapo" => $post->getChapo(),
                	"auteur" => $post->getAuteur(),
                	"contenu" => $post->getContenu()
            	]
        	);
        
        
	}
	
	/**
	 * [listAction Methode de la fonction list des posts]
	 * @return $list [recuperation des infomations relatif a la function select du fichier PostManager.php.]
	 */
	public function listAction($request)
	{
		$list = $this->db->select();
		echo $this->twig->render('post/listPost.html.twig',
			[
				"list" => $list
			]
		);
	}
	//Methode de la fonction Post
	/**
	 * [showAction description]
	 * @param $query [recuperation des infomations relatif a la function Show du fichier PostManager.php.]
	 */
	public function showAction($request, $id)
	{
		$post = $this->db->show(
			[
				'id' => $id 
			]);
        echo $this->twig->render('post/show.html.twig',
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
	 * [updateAction Methode de la fonction update du post]
	 * @param $query [recuperation des infomations relatif a la function Show du fichier PostManager.php.]
	 * @param $query [recuperation des infomations relatif a la function Update du fichier PostManager.php.]
	 */
	public function updateAction($request, $id)
	{
		
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
			$this->showAction($request, $id);
		}else {
			$post = $this->db->show(
			[
				'id' => $id //recupere l'identifiant du Post
			]);
        	echo $this->twig->render('post/modifPost.html.twig',
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
	}	
}