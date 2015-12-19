<?php

namespace SportFunBundle\Form;

use Doctrine\ORM\EntityRepository;
use SportFunBundle\Entity\StadiumTennis;
use SportFunBundle\Entity\StateRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Choice;

class StadiumTennisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var StadiumTennis $stadium */
        $stadium = $options['data']['stadium'];
        $builder
            ->add('courts', 'entity' ,[
                'class' => 'SportFunBundle:TennisCourt',
                'choices' => $stadium->getCourts()
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sportfunbundle_stadiumtennis';
    }
}
