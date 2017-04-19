<?php

namespace BriefcaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CaseType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		-> add('name')
		-> add('number')
		-> add('desctiption')
		-> add('isItCourtCase')
		-> add('courtCaseNumber')
		-> add('company')
		;
	}
}