<?php

namespace App\Entity;

use App\Repository\ConnectedDeviceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConnectedDeviceRepository::class)]
class ConnectedDevice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $deviceId = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Timer $timer = null;

    #[ORM\Column]
    private ?bool $isOn = null;

    

    public function __construct()
    {
        $this->timers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    public function setDeviceId(string $deviceId): static
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getTimer(): ?Timer
    {
        return $this->timer;
    }

    public function setTimer(?Timer $timer): static
    {
        $this->timer = $timer;

        return $this;
    }

    public function isIsOn(): ?bool
    {
        return $this->isOn;
    }

    public function setIsOn(bool $isOn): static
    {
        $this->isOn = $isOn;

        return $this;
    }

    public function turnOn(): self
{
    $this->isOn = true;
    return $this;
}

public function turnOff(): self
{
    $this->isOn = false;
    return $this;
}

public function toggle(): void
{
    $this->isOn = !$this->isOn;
}


   
}
