<?php

namespace BriefcaseBundle\Form;

use BriefcaseBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
	    $builder
            ->add('username', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),))
            ->add('role', ChoiceType::class, array(
                'allow_extra_fields' => true,
                'mapped' => false,
                'choices' => array(
                    'Admin' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER')))
            /*->add('roles', ChoiceType::class, array(
                'data' => array('ROLE_USER'),
                'choices' => array(
                    'Admin' => array('ROLE_ADMIN', ),
                    'User' => array('ROLE_USER', ))))

             ->add('roles', CollectionType::class, array(
                'entry_type' => ChoiceType::class,
                'entry_options' =>  array(
                    'choices' => array(
                        'Admin' => array('ROLE_ADMIN', ),
                        'User' => array('ROLE_USER', ))))) */

        ;
	}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}