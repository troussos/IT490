<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shipment
 *
 * @ORM\Table("shipment")
 * @ORM\Entity
 */
class Shipment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="shipment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var CustomerOrder
     *
     * @ORM\OneToOne(targetEntity="CustomerOrder", inversedBy="shipment")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="customer_order_id")
     */
    private $order;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="shipping_date", type="datetime")
     */
    private $shippingDate;


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
     * Set shippingDate
     *
     * @param \DateTime $shippingDate
     * @return Shipment
     */
    public function setShippingDate($shippingDate)
    {
        $this->shippingDate = $shippingDate;

        return $this;
    }

    /**
     * Get shippingDate
     *
     * @return \DateTime 
     */
    public function getShippingDate()
    {
        return $this->shippingDate;
    }

    /**
     * Set Order
     *
     * @param CustomerOrder $order
     * @return Shipment
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get Order
     *
     * @return CustomerOrder
     */
    public function getOrder()
    {
        return $this->order;
    }
}
