<?php
/** @author troussos * */

namespace Group3\Bundle\ABundle\Service;


use Doctrine\ORM\EntityManager;
use Group3\Bundle\ABundle\Entity\CustomerOrder;
use Group3\Bundle\ABundle\Entity\Invoice;

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
        $user = $order->getCustomer();
        $user->addOrder($order);
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

    public function getOrderBetweenDates($startDate, $stopDate)
    {
        $startDate = (empty($startDate)) ? new \DateTime('0') : new \DateTime($startDate);
        $stopDate = (empty($stopDate)) ? new \DateTime() : new \DateTime($stopDate);

        $repository = $this->entityManager->getRepository('Group3ABundle:' . self::$entityName);

        $query      = $repository->createQueryBuilder('p')
            ->where('p.orderDate BETWEEN :startdate AND :stopdate')
            ->setParameter('startdate', $startDate->format('Y-m-d'))
            ->setParameter('stopdate', $stopDate->format('Y-m-d'))
            ->getQuery();

        return $query->getResult();
    }
}