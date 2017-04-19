<?php

namespace BriefcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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

		return $this -> render('index.html.twig', array('docs' => $docs, ));
	}
}