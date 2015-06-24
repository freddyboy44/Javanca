<?php
namespace Bolt\Extension\MagicT\ContactFormulier\Controller;

use Silex;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use Bolt\Extension\MagicT\ContactFormulier\Entity\ContactFormulier;
use Bolt\Extension\MagicT\ContactFormulier\Form\ContactFormulierType;
use Bolt\Extension\MagicT\ContactFormulier\Securimage;



class ContactFormulierController implements ControllerProviderInterface
{
    private $app;
	public function connect(Silex\Application $app)
    {

    	$ctr = $app['controllers_factory'];
        
        $ctr->match('/contact', function(Request $request, Silex\Application $app) {
            return $this->ToonFormulier($request,$app);
            //dump($request);
            return 1;
        });
        $ctr->match('/contact/verstuurd', function(Request $request, Silex\Application $app) {
            return $app['twig']->render('verstuurd.twig');
        });

        
        $ctr->match('/contact/{parameter}',  function(Request $request, Silex\Application $app) {
            //dump($app);
            //ToonFormulier( $request, $app) {
            
            return $this->ToonFormulier($request,$app);
            
        });
        
        return $ctr;

    }
    public function ToonFormulier(Request $request, Silex\Application $app){
        
        $formulier = new ContactFormulier();

        $form = $app['form.factory']->createBuilder(new ContactformulierType(), $formulier)->getForm();
        
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            //echo "formulier is gepost";
            //$data = $form->getValues();
            

            if ($form->isValid()) {
                $naam = $form['Naam']->getData();
                $email = $form['Email']->getData();
                $telefoon = $form['Telefoon']->getData();
                $vraag = $form['Vraag']->getData();
                $categorie = $form['Categorie']->getData(); 
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $form->addError(new FormError('Emailadres is niet geldig'));
                }else{
                    $captcha_code = $_POST['captcha_code'];
                    $image = new \Securimage();
                    if ($image->check($captcha_code) == true) {
                      // Code is goed ingevoerd, we verzenden de mail
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $message = \Swift_Message::newInstance();
                            $sender = array('info@javanca.be'=> 'Jan Van Cauwenberghe');
                            $to = array($email => $naam);
                            
                           
                            $message->setFrom($sender);
                            $message->setTo(array('boifrederik@telenet.be' => 'Frederik Boi'));
                            $message->setCc($to);
                            $message->setSubject('Uw vraag op Javanca.be');
                            
                            

                            $html = $app['render']->render('email.html.twig', array(
                                        'naam'      => $naam,
                                        'email'     => $email,
                                        'telefoon'  => $telefoon,
                                        'vraag'     => $vraag,
                                        'categorie' => $categorie,
                                    ));
                            

                            $message->setBody($html);
                            $message->setContentType('text/html');
                            //dump($message);

                            if ($app['mailer']->send($message)) {
                                // Goed verstuurd
                                return $app['twig']->render('verstuurd.twig');
                            } else {
                                //Fout bij versturen van mail
                                $form->error('Fout bij versturen van email');
                            }
                               return $app['twig']->render('verstuurd.twig'); 
                        }
                    } else {
                          // Captcha was verkeerd
                        $form->addError(new FormError('Captcha controle mislukt, gelieve opnieuw te proberen'));
                        
                    }
                }
            }else{
                $form->addErro(new FormError('Formulier is niet correct ingevuld, controleer op fouten'));
            }
        }
        return $app['twig']->render('toonformulier.twig', array('form' => $form->createView()));
    }

}

