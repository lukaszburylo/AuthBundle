<?php

namespace nBurylo\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('role')
            ->add('users')
        ;
    }

    public function getName()
    {
        return 'nburylo_authbundle_grouptype';
    }
}
