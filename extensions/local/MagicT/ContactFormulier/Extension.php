<?php

namespace Bolt\Extension\MagicT\ContactFormulier;

use Bolt\Application;
use Bolt\BaseExtension;

include_once(__DIR__ . '/assets/securimage/securimage.php');
include_once(__DIR__ . '/src/Form/ContactformulierType.php');
include_once(__DIR__ . '/src/Controller/MainController.php');
include_once(__DIR__ . '/src/Entity/ContactFormulier.php');



class Extension extends BaseExtension
{
  
    public function initialize() {
        //$this->addCss('assets/extension.css');
        //$this->addJavascript('assets/start.js', true);

        try{
            $this->app->mount('/', new Controller\ContactFormulierController());
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->app['twig.loader.filesystem']->prependPath(__DIR__."/src/Twig");

    }

    public function getName()
    {
        return "ContactFormulier";
    }
}






