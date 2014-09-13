<?php

namespace Group3\Bundle\ABundle\Form;

use Group3\Bundle\ABundle\Entity\Inventory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CustomerOrderType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderDate', 'datetime',
                  array('date_widget' => 'single_text',
                        'time_widget' => 'single_text'
                  ))
            ->add('orderStatus','choice', array(
                'choices'   => array('Preparing' => 'Preparing', 'Shipping' => 'Shipping', 'Delivered' => 'Delivered')
               )
            )
            /*->add('orderDetails', 'entity',
                  array('class' => 'Group3ABundle:OrderDetail',
                        'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('c');
                            }
                  )
            )*/
            ->add('customer', 'entity',
                  array('class' => 'Group3ABundle:Customer',
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('c');
                        }
                )
            )
            ->add('save', 'submit', array(
                'attr' => array('class' => 'pure-button pure-button-primary save-button')
            )
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Group3\Bundle\ABundle\Entity\CustomerOrder'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'group3_bundle_abundle_customerorder';
    }
}
