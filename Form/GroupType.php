<?php

namespace nBurylo\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name','text', array (
					'label'	=> 'Nazwa',
            		))
            ->add('role','text', array (
            		'label'	=> 'Rola (z prefixem ROLE_)'
            		))
        ;
    }

    public function getName()
    {
        return 'nburylo_authbundle_grouptype';
    }
}
