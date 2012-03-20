<?php
namespace nBurylo\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use nBurylo\AuthBundle\Entity\User;
use nBurylo\AuthBundle\Entity\Group;
use nBurylo\AuthBundle\Form\UserType;
use nBurylo\AuthBundle\Form\UserChangePasswordType;

/**
 * @Route("/auth/user", name="_auth_user")
 */
class UserController extends Controller {

	/**
	 * @Route("/list", name="_auth_user_list")
	 * @Template()
	 */
	public function listAction(Request $request) {
		$em = $this->getDoctrine()->getEntityManager();
		$users = $em->getRepository('nBuryloAuthBundle:User')->findAll();
		$groups = $em->getRepository('nBuryloAuthBundle:Group')->findAll();
		return array('users'=>$users, 'groups' => $groups);
	}
	
	/**
	 * @Route("/edit/{id}", name="_auth_user_edit")
	 * @Template()
	 */
	public function editAction(Request $request,$id) {
		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->find('nBuryloAuthBundle:User',$id);
		$form = $this->createForm(new UserType(), $user);
		
		if($request->getMethod() == "POST"){
			$form->bindRequest($request);
			if($form->isValid()){
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($user);
				$em->flush();
				$this->get('session')->setFlash('notice', "Zmodyfikowano");
			}	
		}
		return array(
			'form' => $form->createView(),
			'id' => $id,		
		);
	}
	
	/**
	 * @Route("/changepass", name="_auth_user_changepass")
	 * @Template()
	 */
	public function changePasswordAction(Request $request) {
		$user = $this->get('security.context')->getToken()->getUser();
		$form = $this->createForm(new UserChangePasswordType());
		
		if($request->getMethod() == "POST"){
			$form->bindRequest($request);
			if($form->isValid()){
				$data = $form->getData();
				$factory = $this->get('security.encoder_factory');
				$encoder = $factory->getEncoder($user);
				$old_password = $encoder->encodePassword($data['password_cur'],$user->getSalt());
				if($old_password == $user->getPassword()){
					$new_password = $encoder->encodePassword($data['password'],$user->getSalt());
					$user->setPassword($new_password);
					$em = $this->getDoctrine()->getEntityManager();
					$em->persist($user);
					$em->flush();
					$this->get('session')->setFlash('notice', "Hasło zostało zmienione");
				} else {
					$this->get('session')->setFlash('notice_warning', "obecne hasło niepoprawne");
				}				
			}
		}
		
		return array(
				'form' => $form->createView(),
		);
	}
	
}
?>