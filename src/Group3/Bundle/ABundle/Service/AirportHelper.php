<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;

use Group3\Bundle\ABundle\Entity\Airport;
use Doctrine\ORM\EntityManager;

class AirportHelper extends BaseEntityService
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        self::$entityName = 'Airport';
    }

    /**
     * Return a customer object if the customer id exists, otherwise return an empty
     * customer object
     *
     * @param $id
     *
     * @return Customer|null|object
     */
    public function getAirportIfExists($id)
    {
        if (empty($id))
        {
            return new Airport();
        }

        return $this->getAirportById($id);
    }

    /**
     * Helper function to save the customer entity
     *
     * @param Airport $airport
     */
    public function saveAirport(Airport $airport)
    {
        $this->saveEntity($airport);
    }

    /**
     * Remove the customer based on its id
     *
     * @param $id
     */
    public function removeAirport($id)
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
    public function getAirportById($id)
    {
        return $this->getEntityById($id);
    }

    /**
     * Return all of the customers
     *
     * @return array
     */
    public function getAllAirports()
    {
        return $this->getAllOfEntity();
    }
}