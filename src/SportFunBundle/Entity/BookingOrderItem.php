<?php

namespace SportFunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookingOrderItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BookingOrderItem
{

    const TYPE_ALL = 1;
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
     * @var integer
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="unit_cost", type="float")
     */
    private $unitCost = 0.00;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var boolean
     *
     * @ORM\Column(name="inclusion", type="boolean", nullable = true)
     */
    private $inclusion;

    /**
     * @var float
     *
     * @ORM\Column(name="included_value", type="float")
     */
    private $includedValue = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable = true)
     */
    private $note;

    /**
     * @var Booking
     * @ORM\ManyToOne(targetEntity="Booking", inversedBy="bookingOrderItems")
     * @ORM\JoinColumn(name="booking", referencedColumnName="id")
     */
    private $booking;

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
     * @return Booking
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * @param Booking $booking
     */
    public function setBooking($booking)
    {
        $this->booking = $booking;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return BookingOrderItem
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
     * Set type
     *
     * @param integer $type
     *
     * @return BookingOrderItem
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set unitCost
     *
     * @param float $unitCost
     *
     * @return BookingOrderItem
     */
    public function setUnitCost($unitCost)
    {
        $this->unitCost = $unitCost;

        return $this;
    }

    /**
     * Get unitCost
     *
     * @return float
     */
    public function getUnitCost()
    {
        return $this->unitCost;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return BookingOrderItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set inclusion
     *
     * @param boolean $inclusion
     *
     * @return BookingOrderItem
     */
    public function setInclusion($inclusion)
    {
        $this->inclusion = $inclusion;

        return $this;
    }

    /**
     * Get inclusion
     *
     * @return boolean
     */
    public function getInclusion()
    {
        return $this->inclusion;
    }

    /**
     * Set includedValue
     *
     * @param float $includedValue
     *
     * @return BookingOrderItem
     */
    public function setIncludedValue($includedValue)
    {
        $this->includedValue = $includedValue;

        return $this;
    }

    /**
     * Get includedValue
     *
     * @return float
     */
    public function getIncludedValue()
    {
        return $this->includedValue;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return BookingOrderItem
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}

