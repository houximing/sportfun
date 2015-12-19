<?php

namespace SportFunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Stadium
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SportFunBundle\Entity\StadiumRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="maptype", type="smallint")
 * @ORM\DiscriminatorMap({0 = "Stadium", 1 = "StadiumTennis"})
 */
class Stadium
{

    const TYPE_INDOOR = 0;
    const TYPE_TENNIS = 1;
    const TYPE_RECREATION = 2;
    const TYPE_AQUA = 3;
    const TYPE_FITNESS = 4;
    const TYPE_SIGHT = 5;
    const TYPE_CINIMA = 6;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const CHAIN_YES = 1;
    const CHAIN_NO = 0;


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
     * @ORM\Column(name="code", type="string", length=20)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="abn", type="string", length=100)
     */
    private $abn;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_person", type="string", length=100)
     */
    private $contactPerson;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_number", type="string", length=100)
     */
    private $contactNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_email", type="string", length=100)
     */
    private $contactEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=100)
     * @Assert\NotBlank(message="Please, upload the stadium logo in jpg/png format.")
     * @Assert\Image(
     *      maxSize = "1M",
     *      maxSizeMessage = "File is Too big.")
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="chain", type="smallint")
     */
    private $chain;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var Suburb
     *
     * @ORM\ManyToOne(targetEntity="Suburb", inversedBy="stadiums")
     * @ORM\JoinColumn(name="suburb", referencedColumnName="id")
     */
    private $suburb;

    /**
     * @var State
     *
     * @ORM\ManyToOne(targetEntity="State", inversedBy="stadiums")
     * @ORM\JoinColumn(name="state", referencedColumnName="id")
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=15)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=100)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=100)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=100)
     */
    private $tag;


    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status = 1;

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
     * @return Stadium
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
     * Set code
     *
     * @param string $code
     *
     * @return Stadium
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Stadium
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
     * @param Suburb $suburb
     *
     * @return Stadium
     */
    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;

        return $this;
    }

    /**
     * Get suburb
     *
     * @return Suburb
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
     * @return Stadium
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
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Stadium
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
     * @return Stadium
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

    public function getStatusText(){
        $statusMap = [
            self::STATUS_ACTIVE => "Active",
            self::STATUS_INACTIVE => "Inactive",
        ];
        return $statusMap[$this->getStatus()];
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }


    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Stadium
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


    public function getTypeText(){

        $typeMap = self::getTypeMap();

        return $typeMap[$this->getType()];
    }

    public static function getTypeMap(){
        return [
            self::TYPE_AQUA => "Aquatics",
            self::TYPE_CINIMA => "Cinima",
            self::TYPE_FITNESS => "Fitness",
            self::TYPE_INDOOR => "Indoor Sports",
            self::TYPE_TENNIS => "Tennis",
            self::TYPE_RECREATION => "Recreation/Leisure",
            self::TYPE_SIGHT => "Sightseeing",
        ];
    }


    /**
     * Set abn
     *
     * @param string $abn
     *
     * @return Stadium
     */
    public function setAbn($abn)
    {
        $this->abn = $abn;

        return $this;
    }

    /**
     * Get abn
     *
     * @return string
     */
    public function getAbn()
    {
        return $this->abn;
    }

    /**
     * Set contactPerson
     *
     * @param string $contactPerson
     *
     * @return Stadium
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Get contactPerson
     *
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Set contactNumber
     *
     * @param string $contactNumber
     *
     * @return Stadium
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    /**
     * Get contactNumber
     *
     * @return string
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return Stadium
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Stadium
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set chain
     *
     * @param integer $chain
     *
     * @return Stadium
     */
    public function setChain($chain)
    {
        $this->chain = $chain;

        return $this;
    }

    /**
     * Get chain
     *
     * @return integer
     */
    public function getChain()
    {
        return $this->chain;
    }

    public function getChainIcon(){
        $iconMap = [
            self::CHAIN_NO => "glyphicon-remove",
            self::CHAIN_YES => "glyphicon-ok"
        ];
        return $iconMap[$this->getChain()];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * tag1,tag2
     * @return array
     */
    public function getTagParts(){
        $tagParts = [];
        if($this->getTag()){
            $tags = explode(",", $this->getTag());
            foreach($tags as $tag){
                $tagParts[] = trim($tag);
            }
        }
        return $tagParts;
    }

    protected function getAvailability(){

    }

    public static function getInstance($type){
        if($type == self::TYPE_TENNIS) {
            return new StadiumTennis();
        } else {
            return new Stadium();
        }
    }
}
