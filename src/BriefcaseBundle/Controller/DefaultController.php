<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
	/**
	*@Route("/", name="index")
	*/
	public function indexAction()
	{
		$test = "Hello World";
		return $this->render('Briefcase/index.html.twig', array('test' => $test, ));
	}
}