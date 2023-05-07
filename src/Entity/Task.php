<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use App\Service\Util;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $taskId = null;

    #[ORM\Column(nullable: true)]
    private ?string $externalId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?string $timestamp = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: 'text', length: 5000, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $driverName = null;

    #[ORM\Column(length: 255)]
    private ?string $driverEmail = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customer = null;

    #[ORM\Column(nullable: true)]
    private ?int $customerExternalId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customerName = null;

    #[ORM\Column(nullable: true)]
    private ?string $lastEditTimestamp = null;

    #[ORM\Column(nullable: true)]
    private ?string $createdAtTimestamp = null;

    #[ORM\Column(nullable: true)]
    private ?string $lockedAtTimestamp = null;

    #[ORM\Column(nullable: true)]
    private ?string $dbCreatedAtTimestamp = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $time = null;

    public function __construct(array $data)
    {
        $this->taskId = $data['id'];
        $this->externalId = $data['externalId'];
        $this->name = $data['name'];
        $this->timestamp = Util::formatDate($data['timestamp']);
        $this->status = $data['status'];
        $this->type = $data['type'];
        $this->description = $data['description'];
        $this->message = $data['message'];
        $this->driverName = $data['driver']['name'];
        $this->driverEmail = $data['driver']['email'];
        $this->address = Util::formatAddress($data['location']['address']);
        $this->customer = $data['customer'];
        $this->customerExternalId = isset($data['customerExternalId']) ? (int) $data['customerExternalId'] : null;
        $this->customerName = $data['customerName'];
        $this->lastEditTimestamp = $data['lastEditTimestamp'];
        $this->createdAtTimestamp = $data['createdAtTimestamp'];
        $this->lockedAtTimestamp = $data['lockedAtTimestamp'];
        $this->dbCreatedAtTimestamp = $data['dbCreatedAtTimestamp'];
        $this->postalCode = Util::getPostalCodeFromAddress($data['location']['address']);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaskId(): ?int
    {
        return $this->taskId;
    }

    public function setTaskId(int $taskId): self
    {
        $this->taskId = $taskId;

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;

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

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    public function setTimestamp(?string $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDriverName(): ?string
    {
        return $this->driverName;
    }

    public function setDriverName(string $driverName): self
    {
        $this->driverName = $driverName;

        return $this;
    }

    public function getDriverEmail(): ?string
    {
        return $this->driverEmail;
    }

    public function setDriverEmail(string $driverEmail): self
    {
        $this->driverEmail = $driverEmail;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(?string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomerExternalId(): ?int
    {
        return $this->customerExternalId;
    }

    public function setCustomerExternalId(?int $customerExternalId): self
    {
        $this->customerExternalId = $customerExternalId;

        return $this;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(?string $customerName): self
    {
        $this->customerName = $customerName;

        return $this;
    }

    public function getLastEditTimestamp(): ?string
    {
        return $this->lastEditTimestamp;
    }

    public function setLastEditTimestamp(string $lastEditTimestamp): self
    {
        $this->lastEditTimestamp = $lastEditTimestamp;

        return $this;
    }

    public function getCreatedAtTimestamp(): ?string
    {
        return $this->createdAtTimestamp;
    }

    public function setCreatedAtTimestamp(?string $createdAtTimestamp): self
    {
        $this->createdAtTimestamp = $createdAtTimestamp;

        return $this;
    }

    public function getLockedAtTimestamp(): ?string
    {
        return $this->lockedAtTimestamp;
    }

    public function setLockedAtTimestamp(?string $lockedAtTimestamp): self
    {
        $this->lockedAtTimestamp = $lockedAtTimestamp;

        return $this;
    }

    public function getDbCreatedAtTimestamp(): ?string
    {
        return $this->dbCreatedAtTimestamp;
    }

    public function setDbCreatedAtTimestamp(?string $dbCreatedAtTimestamp): self
    {
        $this->dbCreatedAtTimestamp = $dbCreatedAtTimestamp;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): self
    {
        $this->time = $time;

        return $this;
    }
}
