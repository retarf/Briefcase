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
		return $this -> render('default/index.html.twig');
	}
}