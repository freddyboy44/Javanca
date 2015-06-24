<?php

namespace Bolt\Extension\MagicT\ContactFormulier\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactFormulierType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
			->add('Naam', 'text', array(
                    'required' => true,
                    'attr' => array(
				        'placeholder' => 'Naam',
                        'class' => 'goed'
				    ),
                    'label' => false

                    ))
            ->add('Email','email', array(
                    'required' => true,
            		'label' => false,
            		'attr' => array(
            			'placeholder' => 'Email',
                        'class' => 'goed'
            		),
            		))
            ->add('Telefoon','text', array(
                    'required' => true,
            		'label' => false,
            		'attr' => array(
            			'placeholder' => 'Telefoon',
                        'class' => 'goed'
            		),
            		))
            ->add('Vraag','textarea', array(
                    'required' => true,
            		'label' => false,
            		'attr' => array(
            			'placeholder' => 'Uw vraag',
                        'class' => 'goed'
            		),
            		))
            ->add('Categorie', 'choice', array(
                'label' => false,
		    	'choices'   => array(
		        'algemeen'   => 'Algemeen',
		        'offerte' => 'Offerte',
		        'sollicitatie'   => 'Sollicitatie',
		    	),
		    	'multiple'  => false,
		    	'expanded' => true,
		    	'preferred_choices' => array('algemeen')))
            ->add('Opslaan', 'submit', array(
            	'label' => 'Versturen'));
	}

	public function getName(){
		return "contactformulier";
	}
}