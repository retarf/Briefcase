<?php

namespace tests\BriefcaseBundle\Form;

use BriefcaseBundle\Form\CourCaseType;
use BriefcaseBundle\Entity\CourtCase;
use Symfony\Component\Form\Test\TypeTestCase;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Common\Persistence\ObjectManager;


class CourtCaseTypeTest extends TypeTestCase
{
	/**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    private $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this -> em = $entityManager;
    }

    /**
     * {@inheritDoc}
     */

    protected function setUp()
    {

         // $this->entityManager
         //    ->get('doctrine')
         //    ->getManager();
    }

	public function testSubmitValidData()
	{
		$company = $this -> em -> getRepository('BriefcaseBundle:CourtCase') -> findById(1);
		$this -> assertCount(1, $company);

		$formData = array(
			'name' => 'test',
			'number' => 'test',
			'description' => 'test',
			'itIsCourtCase' => 'Yes',
			'courtCaseNumber' => 'test',
			'company' => $company,
			);

		$form = $this -> factory -> create(CourtCaseType::class);
		$object = CourtCase::fromArray($formData);
		$form -> subbit($formData);		

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());


	}


	/**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this -> em -> close();
        $this -> em = null;
    }
}