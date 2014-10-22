<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerOrder
 *
 * @ORM\Table("customer_order")
 * @ORM\Entity
 */
class CustomerOrder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="customer_order_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="orders")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     */
    private $customer;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="datetime")
     */
    private $orderDate;
    /**
     * @var float
     *
     * @ORM\Column(name="total_amount", type="float")
     */
    private $totalAmount;
    /**
     * @var string
     *
     * @ORM\Column(name="order_status", type="string", length=255)
     */
    private $orderStatus;
    /**
     * @ORM\ManyToMany(targetEntity="OrderDetail", cascade={"all"})
     * @ORM\JoinTable(name="join_orderDetail",
     *      joinColumns={@ORM\JoinColumn(name="order_id", referencedColumnName="customer_order_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="orderDetail_id", referencedColumnName="order_id", unique=true)}
     *      )
     **/
    private $orderDetails;
    /**
     * @var Invoice
     *
     * @ORM\Column(name="invoice", type="string", length=255)
     **/
    private $invoice;
    /**
     * @ORM\Column(name="shipment", type="string", length=255)
     */
    private $shipment;

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
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     *
     * @return CustomerOrder
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set totalAmount
     *
     * @param float $totalAmount
     *
     * @return CustomerOrder
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Set orderStatus
     *
     * @param string $orderStatus
     *
     * @return CustomerOrder
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * Get Customer
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set Customer
     *
     * @param Customer $customer
     *
     * @return CustomerOrder
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    /**
     * @param mixed $orderDetails
     *
     * @return CustomerOrder
     */
    public function setOrderDetails($orderDetails)
    {
        $this->orderDetails = $orderDetails;
        return $this;
    }

    public function addOrderDetails($orderDetails)
    {
        $this->orderDetails->add($orderDetails);
        return $this;
    }

    public function removeOrderDetails($orderDetails)
    {
        $this->orderDetails->removeElement($orderDetails);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed $invoice
     *
     * @return CustomerOrder
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * @param string $shipment
     *
     * @return CustomerOrder
     */
    public function setShipment($shipment)
    {
        $this->shipment = $shipment;
        return $this;
    }
}