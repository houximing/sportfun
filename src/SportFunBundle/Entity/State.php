<?php

namespace SportFunBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SportFunBundle\Entity\StateRepository")
 */
class State
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20)
     */
    private $name;

    /**
     * @var Stadium[]
     * @ORM\OneToMany(targetEntity="Stadium", mappedBy="state")
     */
    private $stadiums;


    public function __construct(){
        $this->stadiums = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return State
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Stadium[]
     */
    public function getStadiums()
    {
        return $this->stadiums;
    }

    /**
     * @param Stadium[] $stadiums
     */
    public function setStadiums($stadiums)
    {
        $this->stadiums = $stadiums;
    }

    /**
     * @param Stadium $stadium
     */
    public function addStadium($stadium){
        $this->stadiums->add($stadium);
    }


    /**
     * Remove stadium
     *
     * @param \SportFunBundle\Entity\Stadium $stadium
     */
    public function removeStadium(\SportFunBundle\Entity\Stadium $stadium)
    {
        $this->stadiums->removeElement($stadium);
    }

    public function __toString(){
        return $this->getName();
    }
}
