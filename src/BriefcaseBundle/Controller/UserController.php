<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BriefcaseBundle\Entity\User;
use BriefcaseBundle\Form\UserType;
use Symfony\Component\Config\Definition\Exception\Exception;

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
			$data = $request->request->get('user');
			$role = $data['role'];
			$username = $data['username'];
			$user -> setRoles($role);

			$password = $this->get('security.password_encoder')
				->encodePassword($user, $user->getPlainPassword());
			$user -> setPassword($password);

			try {
				$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:User');
				$try = $repository -> findOneByUsername($username);
				if ($try == NULL)
				{
					$em = $this -> getDoctrine() -> getManager();
					$em -> persist($user);
					$em -> flush();
				}
				else
				{					
					throw new Exception('Username exists');
				}

				return $this -> redirectToRoute('user_list');
			}
			catch(Exception $e)
			{
				if ($e -> getMessage() == 'Username exists')
				{
					$this -> addFlash('username', $e -> getMessage());
				}
				else
				{
					echo $e -> getMessage();
				}

			}

		}

		return $this -> render('user/form.html.twig', array('form' => $form -> createView(),));

	}
}