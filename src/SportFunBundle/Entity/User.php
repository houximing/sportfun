<?php
// src/AppBundle/Entity/User.php

namespace SportFunBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Stadium $stadiums
     * @ORM\OneToMany(targetEntity="Stadium", mappedBy="user")
     */
    protected $stadiums;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->stadiums = new ArrayCollection();
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

}
