<?php

namespace App\Entity;

use App\Entity\Pictures;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Pictures",mappedBy="serviceUser", cascade={"persist", "remove"})
     */
    private $logo;

    public function __construct()
    {
        $this->logo = new ArrayCollection();
    }
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

    /**
     * @return Collection|Pictures[]
     */
    public function getLogo(): Collection
    {
        return $this->logo;
    }

    public function addLogo(Pictures $logo): self
    {
        if (!$this->logo->contains($logo)) {
            $this->logo[] = $logo;
            $logo->setServiceUser($this);
        }

        return $this;
    }

    public function removeLogo(Pictures $logo): self
    {
        if ($this->logo->contains($logo)) {
            $this->logo->removeElement($logo);
            // set the owning side to null (unless already changed)
            if ($logo->getServiceUser() === $this) {
                $logo->setServiceUser(null);
            }
        }
        return $this;
    }

}
