<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;

use Group3\Bundle\ABundle\Entity\Aircraft;
use Doctrine\ORM\EntityManager;

class AircraftHelper extends BaseEntityService
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        self::$entityName = 'Aircraft';
    }

    /**
     * Return a customer object if the customer id exists, otherwise return an empty
     * customer object
     *
     * @param $id
     *
     * @return Customer|null|object
     */
    public function getAircraftIfExists($id)
    {
        if (empty($id))
        {
            return new Aircraft();
        }

        return $this->getAircraftById($id);
    }

    /**
     * Helper function to save the customer entity
     *
     * @param Aircraft $aircraft
     */
    public function saveAircraft(Aircraft $aircraft)
    {
        $this->saveEntity($aircraft);
    }

    /**
     * Remove the customer based on its id
     *
     * @param $id
     */
    public function removeAircraft($id)
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
    public function getAircraftById($id)
    {
        return $this->getEntityById($id);
    }

    /**
     * Return all of the customers
     *
     * @return array
     */
    public function getAllAircrafts()
    {
        return $this->getAllOfEntity();
    }
}