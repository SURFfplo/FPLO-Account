<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Hslavich\OneloginSamlBundle\Security\User\SamlUserInterface;
use Symfony\Component\Dotenv\Dotenv;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements SamlUserInterface
{
	public function setSamlAttributes(array $attributes)
    {
	    $this->uid = $attributes[getenv('UID')][0];
        $this->givenName = $attributes[getenv('GIVENNAME')][0];
        $this->sn = $attributes[getenv('SN')][0];
        $this->mail = $attributes[getenv('EMAIL')][0];
        $this->eppn = $attributes[getenv('EPPN')][0];
        $this->schacHomeOrganization = $attributes[getenv('SCHACHOME')][0];
    }
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    
    public function getEmail(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
