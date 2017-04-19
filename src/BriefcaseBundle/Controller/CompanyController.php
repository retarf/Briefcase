<?php

namespace BriefcaseBundle\Controller;

use BriefcaseBundle\Entity\Company;
use BriefcaseBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
*@Route("company")
*/
class CompanyController extends Controller
{
	/**
	*@Route("/", name="company_list")
	*/
	public function indexAction()
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Company');
		$companys = $repository -> findBy(array(), array('name' => 'ASC'));

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
	*@Route("/{companyId}", name="display")
	*/
	public function displayAction($companyId)
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Company');
		$company = $repository -> findOneById($companyId);


		if($company == null)
		{

		}
		else
		{
			return $this -> render('company/display.html.twig', array('company' => $company, 'cases'));
			
		}

	}

	/**
	*@Route("/edit/{companyId}", name="edit")
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
	*@Route("/delete/{companyId}", name="delete")
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