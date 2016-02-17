<?php

namespace SportFunBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SportFunBundle\Entity\BookingRepository")
 */
class Booking
{
    const STATUS_AWAITING = 0;
    const STATUS_COMPLETE = 1;
    const STATUS_VOID = 2;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime_created", type="datetime")
     */
    private $datetimeCreated;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="Suburb", type="string", length=255, nullable=true)
     */
    private $suburb;

    /**
     * @var State
     * @ORM\ManyToOne(targetEntity="State", inversedBy="bookings")
     * @ORM\JoinColumn(name="state", referencedColumnName="id")
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="Postcode", type="string", nullable=true)
     */
    private $postcode;

    /**
     * @var BookingOrderItem[]
     * @ORM\OneToMany(targetEntity="BookingOrderItem", mappedBy="booking", cascade={"persist"})
     */
    private $bookingOrderItems;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="bookings")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    public function __construct(){
        $this->bookingOrderItems = new ArrayCollection();
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
     * Set datetimeCreated
     *
     * @param \DateTime $datetimeCreated
     *
     * @return Booking
     */
    public function setDatetimeCreated($datetimeCreated)
    {
        $this->datetimeCreated = $datetimeCreated;

        return $this;
    }

    /**
     * Get datetimeCreated
     *
     * @return \DateTime
     */
    public function getDatetimeCreated()
    {
        return $this->datetimeCreated;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Booking
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
     * Set total
     *
     * @param float $total
     *
     * @return Booking
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Booking
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
     * Set address
     *
     * @param string $address
     *
     * @return Booking
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set suburb
     *
     * @param string $suburb
     *
     * @return Booking
     */
    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;

        return $this;
    }

    /**
     * Get suburb
     *
     * @return string
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * Set state
     *
     * @param State $state
     *
     * @return Booking
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return BookingOrderItem[]
     */
    public function getBookingOrderItems()
    {
        return $this->bookingOrderItems;
    }

    /**
     * @param BookingOrderItem[] $bookingOrderItems
     */
    public function setBookingOrderItems($bookingOrderItems)
    {
        $this->bookingOrderItems = $bookingOrderItems;
    }

    /**
     * @param BookingOrderItem $bookingOrderItem
     */
    public function addBookingOrderItem($bookingOrderItem){
        $this->bookingOrderItems->add($bookingOrderItem);
        $bookingOrderItem->setBooking($this);
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }


}

