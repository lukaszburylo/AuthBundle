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
            ->add('salt')
            ->add('password')
            ->add('email')
            ->add('isActive')
        ;
    }

    public function getName()
    {
        return 'nburylo_authbundle_usertype';
    }
}
