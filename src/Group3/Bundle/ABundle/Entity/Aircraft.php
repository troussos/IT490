<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aircraft
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Aircraft
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
     * @ORM\Column(name="tailNumber", type="string", length=5)
     */
    private $tailNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=4)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="fuelQuantity", type="string", length=5)
     */
    private $fuelQuantity;

    /**
     * @ORM\OneToMany(targetEntity="Flight", mappedBy="aircraft", cascade={"persist","remove"})
     */
    private $flights;


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
     * Set tailNumber
     *
     * @param string $tailNumber
     * @return Aircraft
     */
    public function setTailNumber($tailNumber)
    {
        $this->tailNumber = $tailNumber;

        return $this;
    }

    /**
     * Get tailNumber
     *
     * @return string 
     */
    public function getTailNumber()
    {
        return $this->tailNumber;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Aircraft
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set fuelQuantity
     *
     * @param string $fuelQuantity
     * @return Aircraft
     */
    public function setFuelQuantity($fuelQuantity)
    {
        $this->fuelQuantity = $fuelQuantity;

        return $this;
    }

    /**
     * Get fuelQuantity
     *
     * @return string 
     */
    public function getFuelQuantity()
    {
        return $this->fuelQuantity;
    }

    /**
     * @return mixed
     */
    public function getFlights()
    {
        return $this->flights;
    }

    /**
     * @param mixed $flights
     */
    public function setFlights($flights)
    {
        $this->flights = $flights;
        return $this;
    }

    public function __toString()
    {
        return $this->getTailNumber();
    }
}
