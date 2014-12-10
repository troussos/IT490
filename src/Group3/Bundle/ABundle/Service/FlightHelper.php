<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;

use Group3\Bundle\ABundle\Entity\Flight;
use Doctrine\ORM\EntityManager;

class FlightHelper extends BaseEntityService
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        self::$entityName = 'Flight';
    }

    /**
     * Return a customer object if the customer id exists, otherwise return an empty
     * customer object
     *
     * @param $id
     *
     * @return Customer|null|object
     */
    public function getFlightIfExists($id)
    {
        if (empty($id))
        {
            return new Flight();
        }

        return $this->getFlightById($id);
    }

    /**
     * Helper function to save the customer entity
     *
     * @param Flight $flight
     */
    public function saveFlight(Flight $flight)
    {
        $this->saveEntity($flight);
    }

    /**
     * Remove the customer based on its id
     *
     * @param $id
     */
    public function removeFlight($id)
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
    public function getFlightById($id)
    {
        return $this->getEntityById($id);
    }

    /**
     * Return all of the customers
     *
     * @return array
     */
    public function getAllFlights()
    {
        return $this->getAllOfEntity();
    }
}