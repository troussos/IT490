<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Service;

use Doctrine\ORM\EntityManager;

abstract class BaseEntityService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Holds the name of the entity that the service is for.
     * Must be set by child class.
     *
     * @var string
     */
    protected static $entityName;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * Generic function to return all entities of type
     *
     * @return array
     */
    protected function getAllOfEntity()
    {
        return $this->entityManager->getRepository('Group3ABundle:' . self::$entityName)->findAll();
    }

    /**
     * Generic function to return entity of type by id
     *
     * @param $id
     *
     * @return null|object
     */
    protected function getEntityById($id)
    {
        if(!empty($id))
        {
            return $this->entityManager->find('Group3ABundle:' . self::$entityName ,$id);
        }
    }

    /**
     * Generic function to remove entity by id
     *
     * @param $id
     */
    protected function removeEntityById($id)
    {
        $entity = $this->getEntityById($id);

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    /**
     * Generic function to save entity
     *
     * @param $entity
     */
    protected function saveEntity($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
} 