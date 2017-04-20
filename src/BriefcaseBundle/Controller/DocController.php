<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BriefcaseBundle\Entity\Document;
use BriefcaseBundle\Form\DocType;

/**
*@Route("doc")
*/
class DocController extends Controller
{
	/**
	*@Route("/", name="doc_list")
	*/
	public function indexAction()
	{
		$repository = $this -> getDoctrine() -> getRepository('BriefcaseBundle:Document');
		$docs = $repository -> findAll();

		return $this -> render('/doc/index.html.twig', array('docs' => $docs, ));
	}

	/**
	*@Route("/add", name="doc_add")
	*/
	public function addAction(Request $request)
	{
		$doc = new Document();

		$form = $this -> createForm(DocType::class, $doc);
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

			return $this -> redirectToRoute('doc_list');
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