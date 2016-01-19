<?php

namespace SportFunBundle\Form\Admin;

use Doctrine\ORM\EntityRepository;
use SportFunBundle\Entity\Stadium;
use SportFunBundle\Entity\StateRepository;
use SportFunBundle\Form\EquipmentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Choice;

class AdminStadiumType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('contactPerson')
            ->add('contactNumber')
            ->add('contactEmail')
            ->add('description','textarea',[
                'attr' => [
                    'placeholder' => 'Please add descriptions'
                ]
            ])
            ->add('logo','file',[
                'label' => 'Upload logo',
                'data_class' => null
            ])
            ->add('tag')
            ->add('address')
            ->add('suburb','entity',[
                'class' => 'SportFunBundle:Suburb',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.name', 'ASC');
                }
            ])
            ->add('state','entity',[
                'class' => 'SportFunBundle:State',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.name', 'ASC');
                }
            ])
            ->add('postcode')
            ->add('incinsurance','choice',[
                "choices" => [
                    "Yes" => true,
                    "No" => false
                ],'choices_as_values' => true,
                'label' => 'Does your listed prices including any insurances?'
            ] )
            ->add('incGST','choice',[
                "choices" => [
                    "Yes" => true,
                    "No" => false
                ],'choices_as_values' => true,
                'label' => 'Does the GST included in the price?'
            ] )
            ->add('equipRequired','choice',[
                "choices" => [
                    "Yes" => true,
                    "No" => false
                ],'choices_as_values' => true,
                'label' => 'Does your venue require customer to hire the necessary activitity related equipment?'
            ] )
            ->add('equipments','collection', [
                'type' => new EquipmentType(),
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
            ->add('submit', 'submit', array('label' => 'Save','attr'=>[
                'class' => 'btn btn-success'
            ]))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SportFunBundle\Entity\Stadium',
            'csrf_protection'   => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sportfunbundle_stadiumadmin';
    }
}
