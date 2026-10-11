# Acme Billing

Internal invoicing service for Acme: it issues invoices, stores the rendered
PDFs and exposes a small authenticated API for customers to list and download
their own invoices.

## Development

```bash
composer install
symfony serve
```

## Domain

- `App\Entity\Invoice` — a customer invoice, with the path to its rendered PDF.
- `App\Controller\InvoiceController` — the list / download endpoints.
- `App\Security\Voter\InvoiceVoter` — access control: a customer may only see
  their own invoices.
