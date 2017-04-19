<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BriefcaseBundle\Entity\CourtCase;
use BriefcaseBundle\Entity\Company;
use  Doctrine\Common\Collections;

/**
*@Route("case")
*/
class CaseController extends Controller
{
	/**
	*@Route("/", name="case_list")
	*/
	public function indexAction()
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:CourtCase');
		$cases = $repository -> findAll();

		return $this -> render('case/index.html.twig', array('cases' => $cases, ));
	}

}