<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BriefcaseBundle\Entity\CourtCase;
use BriefcaseBundle\Entity\Company;
use Doctrine\Common\Collections;
use Symfony\Component\HttpFoundation\Request;
use BriefcaseBundle\Form\CourtCaseType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
*@Route("case")
*/
class CaseController extends Controller
{
	/**
	*@Route("/", name="case_list")
	*/
	public function indexAction(Request $request)
	{
		$session = $request -> getSession();
		$session -> set('companyId', NULL);

		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:CourtCase');
		$cases = $repository -> findAll();


		return $this -> render('case/index.html.twig', array('cases' => $cases, ));
	}

	/**
	*@Route("/add", name="case_add")
	*/
	public function addAction(Request $request)
	{
		$session = $request -> getSession();
		$companyId = $session -> get('companyId');

		$case = new CourtCase();
		$form = $this -> createForm(CourtCaseType::class, $case);

		if ($companyId !== NULL)
		{
			$companyReference = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Company');
			$company = $companyReference -> findOneById($companyId);
			$companyName = $company -> getName();

			CourtCaseType::displayCompanyName($form, $companyName);

			$case -> setCompany($company);
		}

		$form -> handleRequest($request);

		if($form -> isSubmitted() && $form -> isValid())
		{
			$em = $this -> getDoctrine() -> getManager();
			$em -> persist($case);
			$em -> flush();

			return $this -> redirectToRoute('case_list');
		}


		return $this->render('case/form.html.twig', array('form' => $form -> createView(), ));
	}

	/**
	*@Route("/{caseId}", name="case_display")
	*/
	public function displayAction($caseId, Request $request)
	{
		$session = $request -> getSession();
		$session->set('caseId', $caseId);

		try 
		{
			$repository = $this -> getDoctrine() ->getRepository('BriefcaseBundle:CourtCase');
			$case = $repository -> findOneById($caseId);

			$docRepo = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Document');
			$docs = $docRepo -> findByCourtCase($caseId);
		}
		catch(Expresion $e)
		{
			echo $e -> getMessage();
		}


		return $this -> render('case/display.html.twig', array('case' => $case, 'docs' => $docs, ));
	}

	/**
	*@Route("/edit/{caseId}", name="case_edit")
	*/
	public function editAction($caseId)
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:CourtCase');
		$case = $repository -> findOneById($caseId);

		$form = $this -> createForm(CourtCaseType::class, $case);

		$form -> handleRequest($request);

		if($form -> isSubmitted() && $form -> isValid())
		{
			$em = $this -> getDoctrine() -> getManager();
			$em -> persist($case);
			$em -> flush();

			return $this -> redirectToRoute('case_list');
		}


		return $this->render('case/form.html.twig', array('form' => $form -> createView(), ));
	}

	/**
	*@Route("/delete/{caseId}", name="case_delete")
	*/
	public function deleteAction($caseId)
	{
		$em = $this -> getDoctrine() -> getManager();
		$case = $em -> getRepository('BriefcaseBundle:CourtCase') -> findOneById($caseId);

		$em -> remove($case);
		$em -> flush();

		return $this -> redirectToRoute('case_list');
	}

}