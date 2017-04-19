<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BriefcaseBundle\Entity\CourtCase;
use BriefcaseBundle\Entity\Company;
use Doctrine\Common\Collections;
use Symfony\Component\HttpFoundation\Request;
use BriefcaseBundle\Form\CourtCaseType;

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

	/**
	*@Route("/add", name="case_add")
	*/
	public function addAction(Request $request)
	{
		$case = new CourtCase();
		$form = $this -> createForm(CourtCaseType::class, $case);

		$form -> handleRequest($request);

		return $this->render('case/form.html.twig', array('form' => $form -> createView(), ));
	}

}