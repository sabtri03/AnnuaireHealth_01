<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"serviceUser" = "ServiceUser", "worker" = "Worker"})
 */

abstract class User implements UserInterface
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseStreet;

    /**
     * @ORM\Column(type="boolean")
     */
    private $banned;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inscribe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $inscribeDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbTry;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodePostal", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $postCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localite", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */ //, unique=true
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresseNumber(): ?string
    {
        return $this->adresseNumber;
    }

    public function setAdresseNumber(?string $adresseNumber): self
    {
        $this->adresseNumber = $adresseNumber;

        return $this;
    }

    public function getAdresseStreet(): ?string
    {
        return $this->adresseStreet;
    }

    public function setAdresseStreet(?string $adresseStreet): self
    {
        $this->adresseStreet = $adresseStreet;

        return $this;
    }

    public function getBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function getInscribe(): ?bool
    {
        return $this->inscribe;
    }

    public function setInscribe(bool $inscribe): self
    {
        $this->inscribe = $inscribe;

        return $this;
    }

    public function getInscribeDate(): ?\DateTimeInterface
    {
        return $this->inscribeDate;
    }

    public function setInscribeDate(\DateTimeInterface $inscribeDate): self
    {
        $this->inscribeDate = $inscribeDate;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNbTry(): ?int
    {
        return $this->nbTry;
    }

    public function setNbTry(int $nbTry): self
    {
        $this->nbTry = $nbTry;

        return $this;
    }


    public function getPostCode(): ?CodePostal
    {
        return $this->postCode;
    }

    public function setPostCode(?CodePostal $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCity(): ?Localite
    {
        return $this->city;
    }

    public function setCity(?Localite $city): self
    {
        $this->city = $city;

        return $this;
    }



    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles ()
    {
        return ['ROLE_USER'];
    }

    public function getUsername ()
    {
        return $this->email;
    }

    public function getSalt ()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials ()
    {
        // TODO: Implement eraseCredentials() method.
    }




}
