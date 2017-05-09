<?php

namespace BriefcaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use BriefcaseBundle\Entity\Document;

class DocType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		-> add('is_incoming', ChoiceType::class, array(
			'choices' => array(
				'Przychodzący' => true,
				'Wychodzący' => false,
				)))
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
		-> add('company', EntityType::class, array(
			'class' => 'BriefcaseBundle:Company',
			'choice_label' => 'name',
			))
		-> add('responseTo')
		-> add('court')
		-> add('file', FileType::class, array(
			'label' => 'Document (PDF file)',
			'data_class' => null,
			))
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => Document::class,
	    ));
	}

	public function displayCaseName($form, $courtCaseName)
	{
		$form -> add('court_case', EntityType::class, array(
			'class' => 'BriefcaseBundle:CourtCase',
			'choice_label' => 'name',
			'disabled' => true,
			'placeholder' => $courtCaseName ));
	}
}