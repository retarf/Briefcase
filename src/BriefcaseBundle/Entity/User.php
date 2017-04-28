<?php

namespace BriefcaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *@ORM\Table(name="users")
 *@ORM\Entity(repositoryClass="BriefcaseBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
	/**
	 *@ORM\Column(type="integer")
	 *@ORM\Id
	 *@ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 *@ORM\Column(type="string", length=255, unique=true)
	 *@Assert\NotBlank()
	 */
	private $username;

	/**
	 *@Assert\NotBlank()
	 *@Assert\Length(max=4096)
	 */
	private $plainPassword;

	/**
	 *ORM\Column(type="string", length=64)
	 */
	private $password;

	private $salt;

	/**
	 *ORM\Column(type="string", length=10)
	 */
	private $roles;

	/**
	 *ORM\Column(type="boolen, name="is_active")
	 */
	private $isActive;

	public function __construct()
	{
		$this->isActive = true;
		$this->salt = md5(uniqid(null, true));
	}

	public function getUsername()
	{
		return $this->username;
	}

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

	public function getSalt()
	{
		return $this->salt;
	}

	public function setRoles($roles)
	{
		$this->roles = $roles;
	}

	public function getRoles()
	{
		return $this->roles;
	}

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->salt
        ) = unserialize($serialized);
    }
}