<?php

namespace SportFunBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StadiumType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('code')
            ->add('type')
            ->add('abn')
            ->add('contactPerson')
            ->add('contactNumber')
            ->add('contactEmail')
            ->add('logo')
            ->add('code')
            ->add('address')
            ->add('suburb')
            ->add('state')
            ->add('postcode')
            ->add('latitude')
            ->add('longitude')
            ->add('chain')
            ->add('status')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SportFunBundle\Entity\Stadium'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sportfunbundle_stadium';
    }
}
