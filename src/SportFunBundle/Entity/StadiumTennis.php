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

    /**
     * @var float
     *
     * @ORM\Column(name="hirepad_price", type="float")
     */
    private $hirepadPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string")
     */
    private $unit;


    /**
     * @var float
     *
     * @ORM\Column(name="unit_price", type="decimal", precision=10, scale=2)
     */
    private $unitPrice;

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

    /**
     * @return float
     */
    public function getHirepadPrice()
    {
        return $this->hirepadPrice;
    }

    /**
     * @param float $hirepadPrice
     */
    public function setHirepadPrice($hirepadPrice)
    {
        $this->hirepadPrice = $hirepadPrice;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }


}

