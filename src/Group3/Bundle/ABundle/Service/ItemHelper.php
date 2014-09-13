<?php
/** @author troussos * */

namespace Group3\Bundle\ABundle\Service;

use Doctrine\ORM\EntityManager;
use Group3\Bundle\ABundle\Entity\Inventory;

class ItemHelper extends BaseEntityService
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        self::$entityName = 'Inventory';
    }

    /**
     * Get the item if the id is valid, otherwise return an empty one.
     *
     * @param $id
     *
     * @return Inventory|null|object
     */
    public function getItemIfExists($id)
    {
        if (empty($id))
        {
            return new Inventory();
        }

        return $this->getItemById($id);
    }

    /**
     * Get all of the items
     *
     * @return array
     */
    public function getAllItems()
    {
        return $this->getAllOfEntity();
    }

    /**
     * Get an item by its id
     *
     * @param $id
     *
     * @return null|object
     */
    public function getItemById($id)
    {
        return $this->getEntityById($id);
    }

    /**
     * Remove by its id
     *
     * @param $id
     */
    public function removeItem($id)
    {
        $this->removeEntityById($id);
    }

    /**
     * Saves the items
     *
     * @param Inventory $item
     */
    public function saveItem(Inventory $item)
    {
        $this->saveEntity($item);
    }
} 