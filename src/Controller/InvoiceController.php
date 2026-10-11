<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class InvoiceController extends AbstractController
{
    #[Route('/invoice/{id}/download', name: 'invoice_download', methods: ['GET'])]
    #[IsGranted('view', 'invoice')]
    public function download(Invoice $invoice): Response
    {
        // Buffer the rendered PDF and return it. Ownership is enforced by the
        // 'view' voter above.
        $pdf = file_get_contents($invoice->getPdfPath());

        return new Response($pdf, Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $invoice->getFilename()),
        ]);
    }
}
