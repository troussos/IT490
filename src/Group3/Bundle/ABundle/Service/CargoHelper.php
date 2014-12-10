<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;

use Group3\Bundle\ABundle\Entity\Cargo;
use Doctrine\ORM\EntityManager;

class CargoHelper extends BaseEntityService
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        self::$entityName = 'Cargo';
    }

    /**
     * Return a customer object if the customer id exists, otherwise return an empty
     * customer object
     *
     * @param $id
     *
     * @return Customer|null|object
     */
    public function getCargoIfExists($id)
    {
        if (empty($id))
        {
            return new Cargo();
        }

        return $this->getCargoById($id);
    }

    /**
     * Helper function to save the customer entity
     *
     * @param Cargo $cargo
     */
    public function saveCargo(Cargo $cargo)
    {
        $this->saveEntity($cargo);
    }

    /**
     * Remove the customer based on its id
     *
     * @param $id
     */
    public function removeCargo($id)
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
    public function getCargoById($id)
    {
        return $this->getEntityById($id);
    }

    /**
     * Return all of the customers
     *
     * @return array
     */
    public function getAllCargos()
    {
        return $this->getAllOfEntity();
    }
}