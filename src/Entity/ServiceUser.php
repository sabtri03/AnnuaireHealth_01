<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceUserRepository")
 */
class ServiceUser extends User
{
   /* /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
   // private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $newsletter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

   /* /**
     * @ORM\OneToOne(targetEntity="App\Entity\Pictures", cascade={"persist", "remove"})
     */
   // private $avatar;
/*
    public function getId(): ?int
    {
        return $this->id;
    }
*/
    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }
/*
    public function getAvatar(): ?Pictures
    {
        return $this->avatar;
    }

    public function setAvatar(?Pictures $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
*/
}
