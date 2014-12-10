<?php

namespace Group3\Bundle\ABundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlightType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('flightNumber')
            ->add('departTime')
            ->add('arrivalTime')
            ->add('aircraft')
            ->add('crew')
            ->add('departAirport')
            ->add('arrivalAirport')
            ->add('cargo')
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
            'data_class' => 'Group3\Bundle\ABundle\Entity\Flight'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'group3_bundle_abundle_flight';
    }
}
