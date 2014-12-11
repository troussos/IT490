<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aircrew
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Aircrew
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
     * @ORM\Column(name="pilot", type="string", length=255)
     */
    private $pilot;

    /**
     * @var string
     *
     * @ORM\Column(name="navigator", type="string", length=255)
     */
    private $navigator;

    /**
     * @ORM\OneToMany(targetEntity="Flight", mappedBy="crew", cascade={"persist","remove"})
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
     * Set pilot
     *
     * @param string $pilot
     * @return Aircrew
     */
    public function setPilot($pilot)
    {
        $this->pilot = $pilot;

        return $this;
    }

    /**
     * Get pilot
     *
     * @return string 
     */
    public function getPilot()
    {
        return $this->pilot;
    }

    /**
     * Set navigator
     *
     * @param string $navigator
     * @return Aircrew
     */
    public function setNavigator($navigator)
    {
        $this->navigator = $navigator;

        return $this;
    }

    /**
     * Get navigator
     *
     * @return string 
     */
    public function getNavigator()
    {
        return $this->navigator;
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
        return $this->getId() . ' - ' . $this->getPilot();
    }
}
