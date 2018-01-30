<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 17.01.18
 * Time: 15:55
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\IdentityTrait;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    use IdentityTrait;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username)
    {
        $this->name = $username;
        return parent::setUsername($username);
    }
}