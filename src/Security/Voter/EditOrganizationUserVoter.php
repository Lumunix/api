<?php

namespace App\Security\Voter;

use App\Entity\OrganizationUser;
use App\Repository\OrganizationUserRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class EditOrganizationUserVoter extends Voter
{
    use AdminOrganizationVoterTrait;

    public function __construct(OrganizationUserRepository $organizationUserRepository)
    {
        $this->organizationUserRepository = $organizationUserRepository;
    }

    protected function supports(string $attribute, $subject)
    {
        return $attribute === Verb::UPDATE && $subject instanceof OrganizationUser;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        return $this->isAllowedToAdministrateOrganization($token, $subject->organization);
    }
}
