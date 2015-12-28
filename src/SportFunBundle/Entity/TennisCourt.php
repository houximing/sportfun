<?php

namespace SportFunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TennisCourt
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SportFunBundle\Entity\TennisCourtRepository")
 */
class TennisCourt
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
     * @var integer
     *
     * @ORM\Column(name="maxpeople", type="integer")
     * @Assert\Type(type="integer", message="Must be an integer.")
     * @Assert\GreaterThan(value="0", message="Must be positive.")
     */
    protected $maxpeople;

    /**
     * @var boolean
     *
     * @ORM\Column(name="canAdd", type="boolean")
     */
    private $canAdd;

    /**
     * @var float
     *
     * @ORM\Column(name="additionalFare", type="float", precision=10, scale=2)
     */
    private $additionalFare;

    /**
     * @var array
     *
     * @ORM\Column(name="availability", type="string")
     */
    private $availability;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * var StadiumTennis
     * @ORM\ManyToOne(targetEntity="StadiumTennis", inversedBy="courts")
     * @ORM\JoinColumn(name="stadium", referencedColumnName="id")
     */
    private $stadium;



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
     * Set maxpeople
     *
     * @param integer $maxpeople
     *
     * @return TennisCourt
     */
    public function setMaxpeople($maxpeople)
    {
        $this->maxpeople = $maxpeople;

        return $this;
    }

    /**
     * Get maxpeople
     *
     * @return integer
     */
    public function getMaxpeople()
    {
        return $this->maxpeople;
    }

    /**
     * Set canAdd
     *
     * @param boolean $canAdd
     *
     * @return TennisCourt
     */
    public function setCanAdd($canAdd)
    {
        $this->canAdd = $canAdd;

        return $this;
    }

    /**
     * Get canAdd
     *
     * @return boolean
     */
    public function getCanAdd()
    {
        return $this->canAdd;
    }

    /**
     * Set additionalFare
     *
     * @param float $additionalFare
     *
     * @return TennisCourt
     */
    public function setAdditionalFare($additionalFare)
    {
        $this->additionalFare = $additionalFare;

        return $this;
    }

    /**
     * Get additionalFare
     *
     * @return float
     */
    public function getAdditionalFare()
    {
        return $this->additionalFare;
    }

    /**
     * Set availability
     *
     * @param array $availability
     *
     * @return TennisCourt
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return array
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return TennisCourt
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return StadiumTennis
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * @param StadiumTennis $stadium
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;
    }

    public function __toString(){
        return $this->getId().'';
    }

}

