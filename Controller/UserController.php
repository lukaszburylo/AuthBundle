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

/**
 * @Route("/auth/user", name="_auth_user")
 */
class UserController extends Controller {

	/**
	 * @Route("/list", name="_auth_user_list")
	 * @Template()
	 */
	public function listAction(Request $request) {
		//$user = new User();
		$em = $this->getDoctrine()->getEntityManager();
		$users = $em->getRepository('nBuryloAuthBundle:User')->findAll();
		$groups = $em->getRepository('nBuryloAuthBundle:Group')->findAll();
		return array('users'=>$users, 'groups' => $groups);

		//$user = $em->find('nBuryloAuthBundle:User','1');
		//$form = $this->createForm(new UserType(), $user);	
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
	
}
?>