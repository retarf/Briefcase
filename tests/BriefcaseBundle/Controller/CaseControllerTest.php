<?php

namespace Test\Briefcase\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

use Briefcase\Controller\CaseController;


class CaseControllerTest extends WebTestCase
{
	public function testIndex(Request $request)
	{
		$session = $request -> getSession();
		$this -> assertEquals(NULL, $session);

	}
}