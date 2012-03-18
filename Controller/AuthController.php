<?php
namespace nBurylo\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use nBurylo\AuthBundle\Entity\User;

/**
 * @Route("/auth", name="_auth")
 */
class AuthController extends Controller {

	/**
	 * @Route("/register", name="_auth_register")
	 */
	public function registerAction(Request $request) {
		$user = new User();
		$form = $this->createFormBuilder($user)
			->add('username',"text", array(
				'label' => 'Login',
				'error_bubbling' => true,
			  ))
			->add('fullname','text', array(
				'label' => 'Imię i nazwisko',
			  ))
			->add('email',"email")
			->add("password","repeated",array(
			  	'type' => 'password',
				'first_name' => 'Hasło',
				'second_name' => 'Powtórz hasło',
				'invalid_message'	=> 'Hasła nie są zgodne',
				'error_bubbling' => true,
				//'options' => array('label'=>"BLA",'always_empty'=>'always_empty')
			  ))
			->getForm();
			
		if($request->getMethod() == "POST"){
			$form->bindRequest($request);
			if($form->isValid()){
				$factory = $this->get('security.encoder_factory');
				$encoder = $factory->getEncoder($user);
				$password = $encoder->encodePassword($user->getPassword(),$user->getSalt());
				$user->setPassword($password);
				
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($user);
				$em->flush();
				
				
				return $this->render("nBuryloAuthBundle:Auth:register_success.html.twig", array(
					'user' => $user->getUsername(),
				));
				
			}
			//$validator = $this->get('validator');
			//$errors = $validator->validate($form);
			
			return $this->render("nBuryloAuthBundle:Auth:register.html.twig", array(
				'form' => $form->createView(),
				//'errors' => $errors,
			));
			
		}
		
		
		return $this->render("nBuryloAuthBundle:Auth:register.html.twig", array(
			'form' => $form->createView(),
			'errors' => '',
			));
	}
	
	/**
	 * @Route("/login", name="_auth_login")
	 * @Template()
	 */
	public function loginAction(Request $request) {
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
	}

	/**
	 * @Route("/login_check", name="_auth_security_check")
	 *
	 */
	public function securityCheckAction() {
		
	}
	
	/**
	 * @Route("/logout", name="_auth_logout")
	 */
	public function logout() {
		
	}
	
	
}


?>