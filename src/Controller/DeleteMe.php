<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/me", methods={"DELETE"})
 */
class DeleteMe extends Api
{
    private TokenStorageInterface $tokenStorage;

    private UserRepository $userRepository;

    public function __construct(TokenStorageInterface $tokenStorage, UserRepository $userRepository)
    {
        $this->tokenStorage = $tokenStorage;
        $this->userRepository = $userRepository;
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->tokenStorage->getToken()->getUser();

        if (!$user instanceof User) {
            throw new UnauthorizedHttpException('Bearer');
        }

        $this->userRepository->delete($user);

        return new JsonResponse();
    }
}
