<?php

namespace nBurylo\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('fullname')
            ->add('email','email')
            ->add('isActive','checkbox',array(
            		'required' => false,
            ))
            ->add("groups",'entity',array(
            		'class' => 'nBuryloAuthBundle:Group',
            		'label'=>"Grupy",
            		'multiple' => true,
            		'expanded'	=> true,
            ))     
        ;
    }
	
    public function getDefaultOptions(array $option) {
    	return array(
    			'data_class' => 'nBurylo\AuthBundle\Entity\User',
    	);
    }
    
    public function getName()
    {
        return 'nburylo_authbundle_usertype';
    }
}
