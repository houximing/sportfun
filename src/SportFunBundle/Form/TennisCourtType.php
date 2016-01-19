<?php

namespace SportFunBundle\Form;

use Doctrine\ORM\EntityRepository;
use SportFunBundle\Entity\StadiumTennis;
use SportFunBundle\Entity\StateRepository;
use SportFunBundle\Entity\TennisCourt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Choice;

class TennisCourtType extends AbstractType
{
    private $courtId = null;
    private $em = null;
    public function __construct($courtId, $em = null){
        $this->courtId = $courtId;
        $this->em = $em;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var TennisCourt $court */
        $court = $this->em->find("SportFunBundle:TennisCourt",$this->courtId);

        $builder
            ->add('maxpeople', 'choice' ,[
                'choices' => range(0,$court->getMaxpeople()),
                'label' => 'Max people'
            ]);
            if($court->getCanAdd()) {
                $builder->add('addition', 'choice', [
                    'choices' => range(1,10),
                    'label' => "Additional number of people (\$ {$court->getAdditionalFare()} / each)"
                ])
                ->add('additionFare','hidden',[
                    'data' => $court->getAdditionalFare()
                ])
                ;

            }

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
        return 'sportfunbundle_stadiumtennis';
    }
}
