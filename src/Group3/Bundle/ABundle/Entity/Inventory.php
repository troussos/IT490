<?php

namespace Group3\Bundle\ABundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Inventory
 *
 * @ORM\Table("inventory")
 * @ORM\Entity
 */
class Inventory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="inventory_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="The item name cannot be blank")
     * @ORM\Column(name="item_name", type="string", length=255)
     */
    private $itemName;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="The item description cannot be blank")
     * @ORM\Column(name="item_description", type="text")
     */
    private $itemDescription;

    /**
     * @var integer
     *
     * @Assert\NotBlank(message="The quantity cannot be blank")
     * @Assert\Type(type="integer", message="The quantity must an numeric")
     * @ORM\Column(name="quantity_in_stock", type="integer")
     */
    private $quantityInStock;

    /**
     * @var float
     *
     * @Assert\NotBlank(message="The price cannot be blank")
     * @Assert\Type(type="float", message="The price must an numeric")
     * @ORM\Column(name="price", type="float")
     */
    private $price;


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
     * Set itemName
     *
     * @param string $itemName
     * @return Inventory
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;

        return $this;
    }

    /**
     * Get itemName
     *
     * @return string 
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set itemDescription
     *
     * @param string $itemDescription
     * @return Inventory
     */
    public function setItemDescription($itemDescription)
    {
        $this->itemDescription = $itemDescription;

        return $this;
    }

    /**
     * Get itemDescription
     *
     * @return string 
     */
    public function getItemDescription()
    {
        return $this->itemDescription;
    }

    /**
     * Set quantityInStock
     *
     * @param integer $quantityInStock
     * @return Inventory
     */
    public function setQuantityInStock($quantityInStock)
    {
        $this->quantityInStock = $quantityInStock;

        return $this;
    }

    /**
     * Get quantityInStock
     *
     * @return integer 
     */
    public function getQuantityInStock()
    {
        return $this->quantityInStock;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Inventory
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
}
