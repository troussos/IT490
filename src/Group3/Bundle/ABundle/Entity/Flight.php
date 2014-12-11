<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flight
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Flight
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
     * @ORM\Column(name="flightNumber", type="string", length=255)
     */
    private $flightNumber;

    /**
     * @var Aircraft
     *
     * @ORM\ManyToOne(targetEntity="Aircraft", inversedBy="flights")
     * @ORM\JoinColumn(name="aircraft_id", referencedColumnName="id")
     */
    private $aircraft;

    /**
     * @ORM\ManyToOne(targetEntity="Aircrew", inversedBy="flights"))
     * @ORM\JoinColumn(name="aircrew_id", referencedColumnName="id")
     */
    private $crew;

    /**
     * @ORM\ManyToOne(targetEntity="Airport", inversedBy="departFlights"))
     * @ORM\JoinColumn(name="depatAirport_id", referencedColumnName="id")
     */
    private $departAirport;

    /**
     * @ORM\ManyToOne(targetEntity="Airport", inversedBy="arrivalFlights"))
     * @ORM\JoinColumn(name="arrivalAirport_id", referencedColumnName="id")
     */
    private $arrivalAirport;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departTime", type="datetime")
     */
    private $departTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrivalTime", type="datetime")
     */
    private $arrivalTime;

    /**
     * @ORM\ManyToMany(targetEntity="Cargo")
     * @ORM\JoinTable(name="join_flightCargo",
     *      joinColumns={@ORM\JoinColumn(name="cargo_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="flight_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $cargo;


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
     * Set flightNumber
     *
     * @param string $flightNumber
     * @return Flight
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    /**
     * Get flightNumber
     *
     * @return string 
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * Set aircraft
     *
     * @param \stdClass $aircraft
     * @return Flight
     */
    public function setAircraft($aircraft)
    {
        $this->aircraft = $aircraft;

        return $this;
    }

    /**
     * Get aircraft
     *
     * @return \stdClass 
     */
    public function getAircraft()
    {
        return $this->aircraft;
    }

    /**
     * Set crew
     *
     * @param \stdClass $crew
     * @return Flight
     */
    public function setCrew($crew)
    {
        $this->crew = $crew;

        return $this;
    }

    /**
     * Get crew
     *
     * @return \stdClass 
     */
    public function getCrew()
    {
        return $this->crew;
    }

    /**
     * Set departAirport
     *
     * @param \stdClass $departAirport
     * @return Flight
     */
    public function setDepartAirport($departAirport)
    {
        $this->departAirport = $departAirport;

        return $this;
    }

    /**
     * Get departAirport
     *
     * @return \stdClass 
     */
    public function getDepartAirport()
    {
        return $this->departAirport;
    }

    /**
     * Set arrivalAirport
     *
     * @param string $arrivalAirport
     * @return Flight
     */
    public function setArrivalAirport($arrivalAirport)
    {
        $this->arrivalAirport = $arrivalAirport;

        return $this;
    }

    /**
     * Get arrivalAirport
     *
     * @return string 
     */
    public function getArrivalAirport()
    {
        return $this->arrivalAirport;
    }

    /**
     * Set departTime
     *
     * @param \DateTime $departTime
     * @return Flight
     */
    public function setDepartTime($departTime)
    {
        $this->departTime = $departTime;

        return $this;
    }

    /**
     * Get departTime
     *
     * @return \DateTime 
     */
    public function getDepartTime()
    {
        return $this->departTime;
    }

    /**
     * Set arrivalTime
     *
     * @param \DateTime $arrivalTime
     * @return Flight
     */
    public function setArrivalTime($arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    /**
     * Get arrivalTime
     *
     * @return \DateTime 
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * Set cargo
     *
     * @param \stdClass $cargo
     * @return Flight
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return \stdClass 
     */
    public function getCargo()
    {
        return $this->cargo;
    }
}
