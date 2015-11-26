<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Locker
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Locker", mappedBy="user")
     */
    private $locker;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set locker
     *
     * @param \AppBundle\Entity\Locker $locker
     *
     * @return User
     */
    public function setLocker(\AppBundle\Entity\Locker $locker = null)
    {
        $this->locker = $locker;

        return $this;
    }

    /**
     * Get locker
     *
     * @return \AppBundle\Entity\Locker
     */
    public function getLocker()
    {
        return $this->locker;
    }
}
