<?php

declare(strict_types=1);

namespace App\Entity;

final class Invoice
{
    public function __construct(
        private int $id,
        private string $customerId,
        private string $pdfPath,
        private string $filename,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getPdfPath(): string
    {
        return $this->pdfPath;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }
}
