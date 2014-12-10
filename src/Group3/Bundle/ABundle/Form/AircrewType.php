<?php

namespace Group3\Bundle\ABundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AircrewType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pilot')
            ->add('navigator')
            ->add('save', 'submit', array(
                'attr' => array('class' => 'pure-button pure-button-primary save-button')
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Group3\Bundle\ABundle\Entity\Aircrew'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'group3_bundle_abundle_aircrew';
    }
}
