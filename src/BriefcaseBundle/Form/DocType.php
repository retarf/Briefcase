<?php

namespace BriefcaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DocType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		-> add('chancelleryNumber')
		-> add('description', TextareaType::class)
		-> add('date', DateType::class, array(
			'widget' => 'choice',
			))
		-> add('court_case', EntityType::class, array(
			'class' => 'BriefcaseBundle:CourtCase',
			'choice_label' => 'name',
			))
		-> add('mailDate', DateType::class, array(
			'widget' => 'choice',
			))
		-> add('sender')
	}
}