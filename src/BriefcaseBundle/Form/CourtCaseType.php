<?php

namespace BriefcaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CourtCaseType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		-> add('name')
		-> add('number')
		-> add('description')
		-> add('isItCourtCase', ChoiceType::class, array(
			'choices' => array(
				'Yes' => true,
				'No' => false, )))
		-> add('courtCaseNumber')
		-> add('company', EntityType::class, array(
			'class' => 'BriefcaseBundle:Company',
			'choice_label' => 'name', ))
		;
	}
}