<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Airport
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Airport
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
     * @ORM\Column(name="code", type="string", length=3)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Flight", mappedBy="departAirport", cascade={"persist","remove"})
     */
    private $departFlights;

    /**
     * @ORM\OneToMany(targetEntity="Flight", mappedBy="arrivalAirport", cascade={"persist","remove"})
     */
    private $arrivalFlights;


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
     * Set code
     *
     * @param string $code
     * @return Airport
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
     * Set name
     *
     * @param string $name
     * @return Airport
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
     * @return mixed
     */
    public function getArrivalFlights()
    {
        return $this->arrivalFlights;
    }

    /**
     * @param mixed $arrivalFlights
     */
    public function setArrivalFlights($arrivalFlights)
    {
        $this->arrivalFlights = $arrivalFlights;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartFlights()
    {
        return $this->departFlights;
    }

    /**
     * @param mixed $departFlights
     */
    public function setDepartFlights($departFlights)
    {
        $this->departFlights = $departFlights;
        return $this;
    }

    public function __toString()
    {
        return $this->getCode();
    }
}
