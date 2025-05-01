<?php

namespace App\Common\Symfony\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

#[AsEventListener(event: KernelEvents::VIEW)]
final class AutoSerializationListener
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function __invoke(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();
        $request = $event->getRequest();
        if ($controllerResult instanceof Response) {
            return;
        }

        $serializationGroups = $request->attributes->get('serialization_groups');

        $json = $this->serializer->serialize($controllerResult, 'json', ['groups' => $serializationGroups]);
        $response = new JsonResponse(
            data: $json,
            status: self::requestMethodToResponseCode($request->getMethod()),
            json: true
        );
        $event->setResponse($response);
    }

    public static function requestMethodToResponseCode(string $method): int
    {
        return match($method) {
            Request::METHOD_POST => 201,
            Request::METHOD_GET => 200,
        };
    }
}