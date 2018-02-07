<?php


namespace Controllers;

use OCFrams\BackController;


class IndexController extends BackController
{
	
	public function indexAction(){

		 echo $this->twig->render('Index/index.html.twig');
	}


	public function contactAction(){

		require '../Src/AppBundle/Form/Contact.php';

		 echo $this->twig->render('Index/contact.html');
	}

}
