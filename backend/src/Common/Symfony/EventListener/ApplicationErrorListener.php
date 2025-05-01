<?php

namespace App\Common\Symfony\EventListener;

use App\Common\Response\Application\ApplicationError;
use App\Common\Response\Application\ErrorCodeEnum;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::VIEW)]
final class ApplicationErrorListener
{
    public function __invoke(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();

        if (! $controllerResult instanceof ApplicationError) {
            return;
        }

        $response = new JsonResponse(
            data: [
                'error' => $controllerResult->getMessage(),
            ],
            status: self::convertErrorCodeEnumToHttpCode($controllerResult->getCode())
        );

        $event->setResponse($response);
    }

    public static function convertErrorCodeEnumToHttpCode(ErrorCodeEnum $code): int
    {
        return match($code) {
            ErrorCodeEnum::UNCONTROLLED_ERROR => 500,
            ErrorCodeEnum::INVALID_REQUEST_ERROR => 400
        };
    }
}