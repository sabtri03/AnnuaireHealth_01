<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkerRepository")
 */
class Worker extends User
{
   /*/**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    //private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailPublic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tvaNb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webSite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pictures", mappedBy="worker", cascade={"persist", "remove"})
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pictures", mappedBy="workerPictures", cascade={"persist", "remove"})
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Services", mappedBy="offer", cascade={"persist"})
     */
    private $services;

    public function __construct()
    {
        $this->logo = new ArrayCollection();
        $this->photo = new ArrayCollection();
        $this->services = new ArrayCollection();
    }
/*
    public function getId(): ?int
    {
        return $this->id;
    }
*/
    public function getemailPublic(): ?string
    {
        return $this->emailPublic;
    }

    public function setEmailPublic(string $emailPublic): self
    {
        $this->emailPublic = $emailPublic;

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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getTvaNb(): ?string
    {
        return $this->tvaNb;
    }

    public function setTvaNb(string $tvaNb): self
    {
        $this->tvaNb = $tvaNb;

        return $this;
    }

    public function getWebSite(): ?string
    {
        return $this->webSite;
    }

    public function setWebSite(?string $webSite): self
    {
        $this->webSite = $webSite;

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
            $logo->setWorker($this);
        }

        return $this;
    }

    public function removeLogo(Pictures $logo): self
    {
        if ($this->logo->contains($logo)) {
            $this->logo->removeElement($logo);
            // set the owning side to null (unless already changed)
            if ($logo->getWorker() === $this) {
                $logo->setWorker(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pictures[]
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Pictures $photo): self
    {
        if (!$this->photo->contains($photo)) {
            $this->photo[] = $photo;
            $photo->setWorkerPictures($this);
        }

        return $this;
    }

    public function removePhoto(Pictures $photo): self
    {
        if ($this->photo->contains($photo)) {
            $this->photo->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getWorkerPictures() === $this) {
                $photo->setWorkerPictures(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addOffer($this);
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            $service->removeOffer($this);
        }

        return $this;
    }
}
