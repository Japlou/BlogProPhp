<?php

require '../Vendor/autoload.php';

use OCFrams\HttPRequest;
use OCFrams\Router;
use OCFrams\Route;
use OCFrams\Database;


$request =  OCFrams\HTTPRequest::createFromGlobals();

$database = new OCFrams\Database($request);

$router = new OCFrams\Router($request);

/**
 *@param  $router: [La methode get et post du fichiers router.php et de la fonction match et call du fichier route.php]
 *Routage de la page d'Acceuil (index.html) qui correspons a la class 'IndexController'.
 */
$router->add(new Route("home", "", [], "Controllers\IndexController", "indexAction"));


/**
 * @param $router [ Routage de la section Contact de la page d'accueil.]
 */

$router->add(new Route("contact", "contact", [], "Controllers\IndexController", "contactAction"));

/**
 * @param $router [Routage de la page creation d'un post (creat.html) qui correspons a la class 'PostController'.]
 * @param $router
 */
 $router->add(new Route("create", "create", [], "Controllers\PostController", "createAction"));


/**
 * @param $router [Chargememt de la fonction delete de la class PostController qui prend en parametre id-delet, se qui correspont a supprimer l'article avec son identifiant (ID).]
 */
 $router->add(new Route("delete", "delete-:id", ["id" => "[0-9]+"], "Controllers\PostController", "deleteAction"));
 $router->add(new Route("validation", "validation-:id", ["id" => "[0-9]+"], "Controllers\PostController", "validationAction"));


/**
 * @param GET $router [Chargememt de la fonction 'list' de la class PostController, se qui correspont a afficher tout les articles de la BDD.]
 */
$router->add(new Route("posts", "posts", [], "Controllers\PostController", "listAction"));


/**
 * @param GET $router [Chargememt de la fonction 'show' de la class PostController qui prend en parametre id-show, se qui correspont a afficher un article avec son identifiant (ID).
]
 */

$router->add(new Route("show", "show-:id", ["id" => "[0-9]+"], "Controllers\PostController", "showAction"));


/**
 * @param GET $router [Chargement de la fonction 'update' de la class postController, qui prend en parametre update-:id, se qui correspont a mettre a jours l'article avec son identifiant (ID).]
 * @param POST $router
 */
$router->add(new Route("update", "update-:id", ["id" => "[0-9]+"], "Controllers\PostController", "updateAction"));

/**
 * @var run $router [charge la fonction run du fichier router.php.]
 */
if($route = $router->match())
{
    $response = $route->call($request, $database);

} else {
    throw new \Exception("Cette route est introuvable");
}
