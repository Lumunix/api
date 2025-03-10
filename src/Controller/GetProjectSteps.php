<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\StepRepository;
use App\Security\Voter\Verb;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projects/{id}/steps", methods={"GET"}, requirements={"id": "[0-9a-z-]+"})
 */
class GetProjectSteps extends Api
{
    private StepRepository $stepRepository;

    public function __construct(StepRepository $stepRepository)
    {
        $this->stepRepository = $stepRepository;
    }

    public function __invoke(Project $project): Response
    {
        $this->denyAccessUnlessGranted(Verb::WRITE_IN, $project);

        return $this->buildSerializedResponse($this->stepRepository->findBy(['project' => $project]), 'READ_STEP');
    }
}
