<?php

namespace BriefcaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CompanyType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			-> add('name')
			-> add('street')
			-> add('number')
			-> add('zip')
			-> add('city')
			-> add('vat')
		;
	}
}