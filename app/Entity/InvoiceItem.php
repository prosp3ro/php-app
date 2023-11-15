<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table("invoice_items")]
class InvoiceItem
{
    #[Id]
    #[Column, GeneratedValue("AUTO")]
    private int $id;

    #[Column(name: "invoice_id")]
    private int $invoiceId;

    #[Column]
    private string $description;

    #[Column]
    private int $quantity;

    #[Column(name: "unit_price", type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $unitPrice;

    public function getId(): int
    {
        return $this->id;
    }

    public function getInvoiceId(): int
    {
        return $this->invoiceId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }
}
