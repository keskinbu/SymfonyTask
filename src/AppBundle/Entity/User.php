<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=25, nullable=false)
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=80, nullable=false)
     */
    private $password;
    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=25, nullable=false)
     */
    private $role;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var
     * 
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    private $posts;
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }
    public function getRoles()
    {
        return array($this->role);
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}