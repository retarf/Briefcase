<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BriefcaseBundle\Entity\Document;
use BriefcaseBundle\Form\DocType;
use BriefcaseBundle\Form\CourtCaseType;
use BriefcaseBundle\Form\CompanyType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
*@Route("doc")
*/
class DocController extends Controller
{
	/**
	*@Route("/", name="doc_list")
	*/
	public function indexAction(Request $request)
	{
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

		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Document');
		$docs = $repository -> findAll();

		return $this -> render('/doc/index.html.twig', array('docs' => $docs, ));
	}

	/**
	*@Route("/add", name="doc_add")
	*/
	public function addAction(Request $request)
	{
		$session = $request -> getSession();
		$companyId = $session -> get('companyId');
		$caseId = $session -> get('caseId');
		
		$doc = new Document();
		$form = $this -> createForm(DocType::class, $doc);

		if ($companyId !== NULL && $caseId !== NULL)
		{
			$companyReference = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Company');
			$company = $companyReference -> findOneById($companyId);
			$companyName = $company -> getName();

			$caseReference = $this -> getDoctrine() -> getRepository('BriefcaseBundle:CourtCase');
			$case = $caseReference -> findOneById($caseId);
			$caseName = $case -> getName();

			CourtCaseType::displayCompanyName($form, $companyName);
			DocType::displayCaseName($form, $caseName);

			$doc -> setCompany($company);
			$doc -> setCourtCase($case);
		}

		$form -> handleRequest($request);
		if($form -> isSubmitted() && $form -> isValid())
		{

			////** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $doc -> getFile();
			$fileName = md5(uniqid()) . '.' . $file -> guessExtension();
			$file -> move($this -> getParameter('doc_dir'), $fileName);

			$doc -> setFile($fileName);

			$em = $this -> getDoctrine() -> getManager();
			$em -> persist($doc);
			$em -> flush();

			if ($caseId !== NULL)
			{
				return $this -> redirectToRoute('case_display', array('caseId' => $caseId));
			}
			else
			{
				return $this -> redirectToRoute('doc_list');
			}
		}

		return $this -> render('doc/form.html.twig', array('form' => $form -> createView(), ));
	}

	/**
	 *@Route("/{docId}", name="doc_display")
	 */
	public function displayAction($docId)
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Document');
		$doc = $repository -> findOneById($docId);

		return $this -> render('doc/display.html.twig', array('doc' => $doc, ));
	}

	/**
	 *@Route("/edit/{docId}", name="doc_edit")
	 */
	public function editAction($docId, Request $request)
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Document');
		$doc = $repository -> findOneById($docId);
		$oldFile = $doc -> getFile();

		$form = $this -> createForm(DocType::class, $doc);
		$form -> handleRequest($request);

		if($form -> isSubmitted() && $form -> isValid())
		{

			if ($form -> get('file') -> getData() !== null)
			{
				$fullPath = $this -> getParameter('doc_dir') . "/" . $oldFile;
				if (file_exists( $fullPath))
					unlink( $fullPath );
			}

			$file = $doc -> getFile();
			$fileName = md5(uniqid()) . '.' . $file -> guessExtension();
			$file -> move($this -> getParameter('doc_dir'), $fileName);

			$doc -> setFile($fileName);

			$em = $this -> getDoctrine() -> getManager();
			$em -> persist($doc);
			$em -> flush();

			return $this -> redirectToRoute('doc_list');
		}

		return $this->render('doc/form.html.twig', array('form' => $form -> createView(), ));
	}


	/**
	 *@Route("/delete/{docId}", name="delete")
	 */
	public function deleteAction($docId)
	{
		$em = $this -> getDoctrine() -> getManager();
		$doc = $em -> getRepository('BriefcaseBundle:Document') -> findOneById($docId);

		$file = $doc -> getFile();
		$file = $this -> getParameter('doc_dir'). '/' . $file;
		unlink($file);

		$em -> remove($doc);
		$em -> flush();

		return $this -> redirectToRoute('doc_list');
	}
}