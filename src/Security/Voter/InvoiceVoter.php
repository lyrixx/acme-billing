<?php

declare(strict_types=1);

namespace App\Security\Voter;

use App\Entity\Invoice;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends Voter<string, Invoice>
 */
final class InvoiceVoter extends Voter
{
    public const string VIEW = 'view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return self::VIEW === $attribute && $subject instanceof Invoice;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        // A customer may only view their own invoices.
        return $subject->getCustomerId() === $user->getUserIdentifier();
    }
}
