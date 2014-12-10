<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cargo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cargo
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
     * @ORM\ManyToOne(targetEntity="CustomerOrder")
     * @ORM\JoinColumn(name="skid_id", referencedColumnName="customer_order_id")
     */
    private $skidId;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=4)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="string", length=255)
     */
    private $contents;


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
     * Set skidId
     *
     * @param string $skidId
     * @return Cargo
     */
    public function setSkidId($skidId)
    {
        $this->skidId = $skidId;

        return $this;
    }

    /**
     * Get skidId
     *
     * @return string 
     */
    public function getSkidId()
    {
        return $this->skidId;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Cargo
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set contents
     *
     * @param string $contents
     * @return Cargo
     */
    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Get contents
     *
     * @return string 
     */
    public function getContents()
    {
        return $this->contents;
    }
}
