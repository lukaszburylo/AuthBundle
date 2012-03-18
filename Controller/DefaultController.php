<?php

namespace nBurylo\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('nBuryloAuthBundle:Default:index.html.twig', array('name' => $name));
    }
}


/*
 		$user = new User();
		$user->setUsername('lukasz');
		$user->setEmail('lukasz@burylo.one.pl');
		//$user->setPassword(sha1('a1'));
		$factory = $this->get('security.encoder_factory');
		$encoder = $factory->getEncoder($user);
		$password = $encoder->encodePassword('a1',$user->getSalt());
		$user->setPassword($password);
		
		
 */