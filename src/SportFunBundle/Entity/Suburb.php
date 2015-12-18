<?php

namespace SportFunBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Suburb
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SportFunBundle\Entity\SuburbRepository")
 */
class Suburb
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=100)
     */
    private $postcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;


    /**
     * @var Stadium[]
     * @ORM\OneToMany(targetEntity="Stadium", mappedBy="suburb")
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
     * @return Suburb
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
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Suburb
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Suburb
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

