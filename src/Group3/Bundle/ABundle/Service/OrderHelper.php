<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;


use Doctrine\ORM\EntityManager;
use Group3\Bundle\ABundle\Entity\CustomerOrder;

class OrderHelper extends BaseEntityService
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        self::$entityName = 'CustomerOrder';
    }

    public function getOrderIfExists($id)
    {
        if (empty($id))
        {
            return new CustomerOrder();
        }

        return $this->getOrderById($id);
    }

    public function saveOrder(CustomerOrder $order)
    {
        $this->saveEntity($order);
    }

    public function removeOrder($id)
    {
        $this->removeEntityById($id);
    }

    public function getOrderById($id)
    {
        $order = $this->getEntityById($id);
        return $order;
    }

    public function getAllOrders()
    {
        $orders = $this->getAllOfEntity();

        return $orders;
    }
} 