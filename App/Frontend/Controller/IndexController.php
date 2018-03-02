<?php


namespace App\Frontend\Controller;

use OCFrams\BackController;
use OCFrams\HTTPRequest;


class IndexController extends BackController
{
	
	public function indexAction(HTTPRequest $request){

		 echo $this->twig->render('Views/index.html.twig');

	}
	
	public function contactAction()
	{
		 echo $this->twig->render('Views/contact.html');
	}

}
