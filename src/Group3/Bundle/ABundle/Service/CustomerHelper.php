<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;

use Group3\Bundle\ABundle\Entity\Customer;
use Doctrine\ORM\EntityManager;

class CustomerHelper extends BaseEntityService
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        self::$entityName = 'Customer';
    }

    /**
     * Return a customer object if the customer id exists, otherwise return an empty
     * customer object
     *
     * @param $id
     *
     * @return Customer|null|object
     */
    public function getCustomerIfExists($id)
    {
        if (empty($id))
        {
            return new Customer();
        }

        return $this->getCustomerById($id);
    }

    /**
     * Helper function to save the customer entity
     *
     * @param Customer $customer
     */
    public function saveCustomer(Customer $customer)
    {
        $this->saveEntity($customer);
    }

    /**
     * Remove the customer based on its id
     *
     * @param $id
     */
    public function removeCustomer($id)
    {
        $this->removeEntityById($id);
    }

    /**
     * Get a customer object based on id
     *
     * @param $id
     *
     * @return null|object
     */
    public function getCustomerById($id)
    {
        return $this->getEntityById($id);
    }

    /**
     * Return all of the customers
     *
     * @return array
     */
    public function getAllCustomers()
    {
        return $this->getAllOfEntity();
    }
}