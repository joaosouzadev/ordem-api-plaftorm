<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SetUserSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setUser', EventPriorities::PRE_WRITE]
        ];
    }

    public function setUser(ViewEvent $event) {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($entity instanceof User || !in_array($method, [Request::METHOD_POST])) {
            return;
        }

        $entity->setUser($this->tokenStorage->getToken()->getUser());
    }
}