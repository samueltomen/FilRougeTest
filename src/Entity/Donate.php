<?php

namespace App\Entity;

use App\Repository\DonateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonateRepository::class)]
class Donate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $stripeId = null;

    #[ORM\Column]
    private ?float $amountPaid = null;

    #[ORM\Column(length: 255)]
    private ?string $hostedInvoidUrl = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStripeId(): ?int
    {
        return $this->stripeId;
    }

    public function setStripeId(int $stripeId): self
    {
        $this->stripeId = $stripeId;

        return $this;
    }

    public function getAmountPaid(): ?float
    {
        return $this->amountPaid;
    }

    public function setAmountPaid(float $amountPaid): self
    {
        $this->amountPaid = $amountPaid;

        return $this;
    }

    public function getHostedInvoidUrl(): ?string
    {
        return $this->hostedInvoidUrl;
    }

    public function setHostedInvoidUrl(string $hostedInvoidUrl): self
    {
        $this->hostedInvoidUrl = $hostedInvoidUrl;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
