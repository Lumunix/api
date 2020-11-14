<?php

namespace App\Controller;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class Api
{
    protected SerializerInterface $serializer;

    protected function buildSerializedResponse($data, string $group, int $statusCode = Response::HTTP_OK): Response
    {
        return new Response(
            $this->serializer->serialize($data, 'json', SerializationContext::create()->setGroups([$group])),
            $statusCode,
            [
                'Content-type' => 'application/json'
            ]
        );
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }
}
