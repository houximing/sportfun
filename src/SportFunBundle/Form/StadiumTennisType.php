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
    private $em = null;
    public function __construct($em = null){
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $optidons
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var StadiumTennis $stadium */
        $stadium = $options['data']['stadium'];
        $courts = $stadium->getCourts();
        $builder
            ->add('court', new TennisCourtType($courts->first()->getId(), $this->em), ['label' => false])
        ;
        if($stadium->getHirepad()) {
            $builder->add('hirepad', 'choice', [
                'choices' => range(0,10),
                'label' => "Hire pad (\$ {$stadium->getHirepadPrice()} / each)"
            ])
            ->add('hirePrice','hidden',[
                'data' => $stadium->getHirepadPrice()
            ])
            ;

        }
        $builder->add('checkout','submit',[
            'label' => 'Check out',
            'attr' => [
                'class' => 'btn-danger'
            ]
        ]);
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
