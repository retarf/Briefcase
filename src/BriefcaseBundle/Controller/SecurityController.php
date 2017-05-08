<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BriefcaseBundle\Entity\User;

class SecurityController extends Controller
{
	/**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
    	try
    	{
    		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:User');
			$admin = $repository -> findOneByRoles('ROLE_ADMIN');

	    	if ($admin === null)
	    	{
	    		$admin = new User();

	    		$admin -> setUsername('admin');
	    		$admin -> setRoles('ROLE_ADMIN');

    			$password = $this->get('security.password_encoder')
    				->encodePassword($admin, 'admin');
            	$admin -> setPassword($password);

	    		$em = $this -> getDoctrine() -> getManager();
	    		$em -> persist($admin);
	    		$em -> flush();
	    	}

    	}
    	catch (Exception $e)
    	{
    		echo $e -> getMessage();
    	}

	    $authenticationUtils = $this->get('security.authentication_utils');

	    // get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getLastUsername();

	    return $this->render('security/login.html.twig', array(
	        'last_username' => $lastUsername,
	        'error'         => $error,
	    ));
    }

}