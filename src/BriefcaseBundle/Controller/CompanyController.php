<?php

namespace BriefcaseBundle\Controller;

use BriefcaseBundle\Entity\Company;
use BriefcaseBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;

/**
*@Route("company")
*/
class CompanyController extends Controller
{
	/**
	*@Route("/", name="company_list")
	*/
	public function indexAction(Request $request)
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Company');
		$companys = $repository -> findBy(array(), array('name' => 'ASC'));

		$session = $request -> getSession();
		$caseId = $session -> get('caseId');
		$companyId = $session -> get('companyId');

		if (!empty($caseId))
		{
			$session -> remove('caseId');
		}
		if (!empty($companyId))
		{
			$session -> remove('companyId');
		}

		return $this->render('company/index.html.twig', array('companys' => $companys, ));
	}

	/**
	*@Route("/add", name="company_add")
	*/
	public function addAction(Request $request)
	{
		$company = new Company();
		$form = $this->createForm(CompanyType::class, $company);

		$form->handleRequest($request);

		if ($form -> isSubmitted() && $form -> isValid())
		{
			$em = $this -> getDoctrine() -> getManager();
			$em->persist($company);
			$em->flush();

			return $this -> redirectToRoute('company_list');
		}

		return $this->render('company/form.html.twig', array('form' => $form -> createView(), ));
	}

	/**
	*@Route("/{companyId}", name="company_display")
	*/
	public function displayAction($companyId, Request $request)
	{
		$session = $request -> getSession();

		$session->set('companyId', $companyId);

		try
		{
			$companyRepository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Company');
			$company = $companyRepository -> findOneById($companyId);

			$casesRepository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:CourtCase');
			$cases = $casesRepository -> findByCompany($companyId);
		}
		catch(Exception $e)
		{
			echo $e -> getMessage();
		}
		finally
		{
			return $this -> render('company/display.html.twig', array('company' => $company, 'cases' => $cases, ));
		}
	}

	/**
	*@Route("/edit/{companyId}", name="company_edit")
	*/
	public function editAction($companyId, Request $request)
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Company');
		$company = $repository -> findOneById($companyId);

		$form = $this->createForm(CompanyType::class, $company);

		$form->handleRequest($request);

		if ($form -> isSubmitted() && $form -> isValid())
		{
			$em = $this -> getDoctrine() -> getManager();
			$em->persist($company);
			$em->flush();

			return $this -> redirectToRoute('company_list');
		}

		return $this->render('company/form.html.twig', array('form' => $form -> createView(), ));
	}

	/**
	*@Route("/delete/{companyId}", name="company_delete")
	*/
	public function deleteAction($companyId)
	{
		$em = $this -> getDoctrine() -> getManager();
		$company = $em -> getRepository('BriefcaseBundle:Company') -> findOneById($companyId);

		$em -> remove($company);
		$em -> flush();

		return $this -> redirectToRoute('company_list');
	}
}