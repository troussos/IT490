<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderDetail
 *
 * @ORM\Table("order_detail")
 * @ORM\Entity
 */
class OrderDetail
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
     * @var Inventory
     *
     * @ORM\ManyToOne(targetEntity="Inventory")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_quantity", type="integer")
     */
    private $itemQuantity;


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
     * Set itemQuantity
     *
     * @param integer $itemQuantity
     * @return OrderDetail
     */
    public function setItemQuantity($itemQuantity)
    {
        $this->itemQuantity = $itemQuantity;

        return $this;
    }

    /**
     * Get itemQuantity
     *
     * @return integer 
     */
    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    /**
     * Set Item
     *
     * @param Inventory $item
     * @return OrderDetail
     */
    public function setItem(Inventory $item)
    {
        $this->item = $item;
        return $this;
    }

    /**
     * Get Item
     *
     * @return Inventory
     */
    public function getItem()
    {
        return $this->item;
    }

}
