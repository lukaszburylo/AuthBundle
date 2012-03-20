<?php

namespace nBurylo\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('password_cur','password', array(
            		'label' => 'Obecne hasło',
            		))
            ->add("password","repeated",array(
			  		'type' => 'password',
					'first_name' => 'Nowe hasło',
					'second_name' => 'Powtórz nowe hasło',
					'invalid_message'	=> 'Hasła nie są zgodne',
					'error_bubbling' => true,
			  		))
        ;
    }
	
    public function getDefaultOptions(array $option) {
    	return array(
    	);
    }
    
    public function getName()
    {
        return 'nburylo_authbundle_userchangepasswordtype';
    }
}
