<?php
namespace OCFrams;
 /**
  * class ApplicationComponent [La class se charge de stocket, pendant la construction de l'objet, l'instance de l'application exécutée.]
  */
class ApplicationComponent
{
  protected $app;
 
  public function __construct(Application $app)
  {
    $this->app = $app;
  }
 
  public function app()
  {
    return $this->app;
  }
}