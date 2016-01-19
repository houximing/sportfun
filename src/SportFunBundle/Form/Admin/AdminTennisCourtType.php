<?php

namespace SportFunBundle\Form\Admin;

use Doctrine\ORM\EntityRepository;
use SportFunBundle\Entity\StadiumTennis;
use SportFunBundle\Entity\StateRepository;
use SportFunBundle\Entity\TennisCourt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Choice;

class AdminTennisCourtType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            ->add('maxpeople', 'integer' ,[
                'label' => 'Max people'
            ])->add('canAdd', 'checkbox', [
                'label' => "Additional number of people?",
                    'required' => false
            ])->add('additionalFare','number',[
                'label' => "Price for each person",
                    'required' => false
                ])->add('submit', 'submit', array('label' => 'Save','attr'=>[
                    'class' => 'btn btn-success'
                ]));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SportFunBundle\Entity\TennisCourt'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sportfunbundle_stadiumtennisadmin';
    }
}
