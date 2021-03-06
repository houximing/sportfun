<?php

namespace SportFunBundle\Form;

use Doctrine\ORM\EntityRepository;
use SportFunBundle\Entity\Stadium;
use SportFunBundle\Entity\StateRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Choice;

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
            ->add('type','choice',[
                'choices' => Stadium::getTypeMap()
            ])
            ->add('abn','text',[
                'label' => "ABN"
            ])
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
            ->add('code')
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
            ->add('latitude')
            ->add('longitude')
            ->add('chain','choice',[
                "choices" => [
                    "Yes" => 1,
                    "No" => 0
                ],'choices_as_values' => true,
            ] )
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
            ->add('status','choice',[
                "choices" => [
                    "Active" => 1,
                    "Inactive" => 0
                ],'choices_as_values' => true,
            ] )
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
