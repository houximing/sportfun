<?php

namespace SportFunBundle\Form;

use Doctrine\ORM\EntityRepository;
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
            ->add('type')
            ->add('abn','text',[
                'label' => "ABN"
            ])
            ->add('contactPerson')
            ->add('contactNumber')
            ->add('contactEmail')
            ->add('logo')
            ->add('code')
            ->add('address')
            ->add('suburb')
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
