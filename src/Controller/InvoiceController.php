<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InvoiceController extends AbstractController
{
    #[Route('/invoice/{id}/download', name: 'invoice_download', methods: ['GET'])]
    public function download(Invoice $invoice): Response
    {
        // Stream the PDF straight from disk instead of buffering it in memory.
        return $this->file($invoice->getPdfPath(), $invoice->getFilename());
    }
}
