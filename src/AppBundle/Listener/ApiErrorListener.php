<?php
namespace AppBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiErrorListener implements EventSubscriberInterface
{

  public function onException(GetResponseForExceptionEvent $e)
  {
    $path = $e->getRequest()->getPathInfo();

    if(0 !== stripos($path, '/api'))
    {
      return;
    }

    if($e->getException() instanceof HttpException)
    {
      /** @var HttpException $exception */
      $exception = $e->getException();
      if($exception->getStatusCode() === 404)
      {
        $e->setResponse(new JsonResponse(['error' => ['message' => 'not found']], Response::HTTP_NOT_FOUND));
      }
    }
  }

  public static function getSubscribedEvents()
  {
    return [KernelEvents::EXCEPTION => ['onException']];
  }
}