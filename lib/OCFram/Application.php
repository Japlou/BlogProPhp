<?php
namespace OCFrams;


class Application
{
  
  protected $httpRequest;
  protected $httpResponse;
  protected $user;
  protected $name;

  public function __construct()
  {
    $this->httpRequest = new HTTPRequest($this);
    $this->httpResponse = new HTTPResponse($this);
    $this->user = new User($this);
    $this->name = 'Frontend';
  }
  
  public function getController()
  {
    $router = new Router();//On instancie la class router
    $xml = new \DOMDocument; //Charge un document XML depuis une chaîne de caractères.
   
    $xml->load(__DIR__.'/../../App/'.$this->name.'/ConfigXML/routes.xml'); //charge le fichier xml
    //getElementsByTagName [Cette fonction retourne une instance de la classe DOMNodeList contenant tous les éléments qui ont un nom de balise donné.]
    $routes = $xml->getElementsByTagName('route');
    // On parcourt les routes du fichier XML.
    foreach ($routes as $route)
    {
      $vars = [];

      // On regarde si des variables sont présentes dans l'URL.    
      if ($route->hasAttribute('vars'))
      { 
        //explode() retourne un tableau de chaînes, chacune d'elle étant une sous-chaîne du paramètre string extraite en utilisant le séparateur delimiter.
        $vars = explode(',', $route->getAttribute('vars'));
      }
      // On ajoute la route au routeur.
      $router->add(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
      
    }
    try
    {
      // On récupère la route correspondante à l'URL.
      $matchedRoute = $router->getRoute($this->httpRequest->getUri());
    }
    catch (\RuntimeException $e)
    {
      if ($e->getCode() == Router::NO_ROUTE)
      {
        // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
        $this->httpResponse->redirect404();
      }
    }
    // On ajoute les variables de l'URL au tableau $_GET.
    $_GET = array_merge($_GET, $matchedRoute->vars());
    
    // On instancie le contrôleur.
    $controllerClass = 'App\\'.$this->name.'\\Controller\\'.$matchedRoute->module();
    return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());

  }
  /**
   * [method run]
   * @var $controller [fait appelle a la methode getController de la class Application et l'éxécute]
   */
  public function run()
  {
    $controller = $this->getController();
    $controller->execute();
  }
  public function httpRequest()
  {
    return $this->httpRequest;
  }
  public function httpResponse()
  {
    return $this->httpResponse;
  }
 public function user()
  {
    return $this->user;
  }
  public function name()
  {
    return $this->name;
  }
}