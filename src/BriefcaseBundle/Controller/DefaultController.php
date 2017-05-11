<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
	/**
	*@Route("/", name="index")
	*/
	public function indexAction()
	{
		date_default_timezone_set('EUROPE/WARSAW');
		$now = date("d-m-Y H:i:s");

		return $this -> render('default/index.html.twig', array('now' => $now));
	}
}