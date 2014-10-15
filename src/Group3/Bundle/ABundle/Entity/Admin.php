<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Entity;

use FOS\UserBundle\Model\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin")
 */
class Admin extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}