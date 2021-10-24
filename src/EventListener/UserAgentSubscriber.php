<?php


namespace App\EventListener;


use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserAgentSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            RequestEvent::class => 'onKernelRequest'
        ];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        $userAgent = $request->headers->get('User-Agent');

        $this->logger->info(sprintf('The User-Agent is %s', $userAgent));
    }
}