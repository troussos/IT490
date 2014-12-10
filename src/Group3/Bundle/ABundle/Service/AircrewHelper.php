<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;

use Group3\Bundle\ABundle\Entity\Aircrew;
use Doctrine\ORM\EntityManager;

class AircrewHelper extends BaseEntityService
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        self::$entityName = 'Aircrew';
    }

    /**
     * Return a customer object if the customer id exists, otherwise return an empty
     * customer object
     *
     * @param $id
     *
     * @return Customer|null|object
     */
    public function getAircrewIfExists($id)
    {
        if (empty($id))
        {
            return new Aircrew();
        }

        return $this->getAircrewById($id);
    }

    /**
     * Helper function to save the customer entity
     *
     * @param Aircrew $aircrew
     */
    public function saveAircrew(Aircrew $aircrew)
    {
        $this->saveEntity($aircrew);
    }

    /**
     * Remove the customer based on its id
     *
     * @param $id
     */
    public function removeAircrew($id)
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
    public function getAircrewById($id)
    {
        return $this->getEntityById($id);
    }

    /**
     * Return all of the customers
     *
     * @return array
     */
    public function getAllAircrews()
    {
        return $this->getAllOfEntity();
    }
}