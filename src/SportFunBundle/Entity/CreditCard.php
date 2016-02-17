<?php

namespace SportFunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreditCard
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SportFunBundle\Entity\CreditCardRepository")
 */
class CreditCard
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
     * @ORM\Column(name="number", type="string", length=30)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="month", type="string", length=2)
     */
    private $month;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=4)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="cvn", type="string", length=10)
     */
    private $cvn;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=255)
     */
    private $hash;


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
     * Set number
     *
     * @param string $number
     *
     * @return CreditCard
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CreditCard
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
     * Set month
     *
     * @param string $month
     *
     * @return CreditCard
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set year
     *
     * @param string $year
     *
     * @return CreditCard
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set cvn
     *
     * @param string $cvn
     *
     * @return CreditCard
     */
    public function setCvn($cvn)
    {
        $this->cvn = $cvn;

        return $this;
    }

    /**
     * Get cvn
     *
     * @return string
     */
    public function getCvn()
    {
        return $this->cvn;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return CreditCard
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
}

