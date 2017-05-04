<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BriefcaseBundle\Entity\User;
use BriefcaseBundle\Form\UserType;

/**
 *@Route("/admin/user")
 */
class UserController extends Controller
{
	/**
	 *@Route("/", name="user_list")
	 */
	public function indexAction()
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:User');
		$users = $repository -> findAll();

		return $this -> render('user/index.html.twig', array('users' => $users));
	}

	/**
	 *@Route("/add", name="user_add")
	 */
	public function addAction(Request $request)
	{
		$user = new User();

		$form = $this -> createForm(UserType::class, $user);
		$form -> handleRequest($request);

		if( $form -> isSubmitted() && $form -> isValid())
		{
			$role = $request->request->get('user');
			$role = $role['role'];
			$user -> setRoles($role);

			$password = $this->get('security.password_encoder')
				->encodePassword($user, $user->getPlainPassword());
			$user -> setPassword($password);

			$em = $this -> getDoctrine() -> getManager();
			$em -> persist($user);
			$em -> flush();
			return $this -> redirectToRoute('user_list');
		}

		return $this -> render('user/form.html.twig', array('form' => $form -> createView(),));

	}
}