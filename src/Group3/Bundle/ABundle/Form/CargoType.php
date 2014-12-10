<?php

namespace Group3\Bundle\ABundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CargoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight')
            ->add('contents')
            ->add('skidId')
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
            'data_class' => 'Group3\Bundle\ABundle\Entity\Cargo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'group3_bundle_abundle_cargo';
    }
}
