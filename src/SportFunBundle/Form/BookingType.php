<?php

namespace SportFunBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datetimeCreated')
            ->add('status')
            ->add('total')
            ->add('name')
            ->add('address')
            ->add('suburb')
            ->add('postcode')
            ->add('state')
            ->add('user')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SportFunBundle\Entity\Booking'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sportfunbundle_booking';
    }
}
