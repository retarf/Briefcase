<?php

namespace Test\Briefcase\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Session;
use BriefcaseBundle\Entity\Company;



use Briefcase\Controller\CaseController;


class CaseControllerTest extends WebTestCase
{
	public function testIndex()
	{
		$session = new Session(new MockArraySessionStorage());

		$companyId = $session -> get('companyId');
		$this -> assertEquals(NULL, $companyId);
	}

}