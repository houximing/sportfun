<?php

namespace SportFunBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * StadiumTennis
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SportFunBundle\Entity\StadiumTennisRepository")
 */
class StadiumTennis extends Stadium
{

    /**
     * @var TennisCourt
     * @ORM\OneToMany(targetEntity="TennisCourt", mappedBy="stadium")
     */
    private $courts;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hirepad", type="boolean")
     */
    private $hirepad;


    public function __construct(){
        $this->courts = new ArrayCollection();
    }

    /**
     * Get court
     *
     * @return TennisCourt[]
     */
    public function getCourts()
    {
        return $this->courts;
    }

    /**
     * @param TennisCourt $courts
     */
    public function setCourts($courts)
    {
        $this->courts = $courts;
    }


    /**
     * @param TennisCourt $court
     */
    public function addCourt($court){
        $this->courts->add($court);
    }

    /**
     * Set hirepad
     *
     * @param boolean $hirepad
     *
     * @return StadiumTennis
     */
    public function setHirepad($hirepad)
    {
        $this->hirepad = $hirepad;

        return $this;
    }

    /**
     * Get hirepad
     *
     * @return boolean
     */
    public function getHirepad()
    {
        return $this->hirepad;
    }

    public function getAvailability(){

    }
}

