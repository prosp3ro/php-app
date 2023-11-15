<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enums\InvoiceStatus;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table("invoices")]
class Invoice
{
    #[Id]
    #[Column, GeneratedValue("AUTO")]
    private int $id;

    #[Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $amount;

    #[Column(name: "invoice_number")]
    private string $invoiceNumber;

    #[Column(enumType: InvoiceStatus::class)]
    private InvoiceStatus $status;

    #[Column(name: "created_at")]
    private DateTime $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function getStatus(): InvoiceStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
