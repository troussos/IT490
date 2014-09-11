<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;


use Doctrine\ORM\EntityManager;
use Group3\Bundle\ABundle\Entity\Customer;

class CustomerHelper
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function getCustomerIfExists($id)
    {
        if (empty($id))
        {
            return new Customer();
        }

        return $this->entityManager->find('Group3ABundle:Customer',$id);
    }

    public function saveCustomer(Customer $customer)
    {
        $this->entityManager->persist($customer);
        $this->entityManager->flush();
    }

    public function removeCustomer($id)
    {
        $customer = $this->entityManager->find('Group3ABundle:Customer',$id);

        $this->entityManager->remove($customer);
        $this->entityManager->flush();
    }

    public function getCustomerById($id)
    {
        if(!empty($id))
        {
            return $this->entityManager->find('Group3ABundle:Customer',$id);
        }
    }

    public function getAllCustomers()
    {
        return $this->entityManager->getRepository('Group3ABundle:Customer')->findAll();
    }
}