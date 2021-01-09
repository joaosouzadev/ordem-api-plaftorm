<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Ordem;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class OrdemSubscriber implements EventSubscriberInterface {
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['ordemConfig', EventPriorities::PRE_WRITE]
        ];
    }

    public function ordemConfig(ViewEvent $event) {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$entity instanceof Ordem || !in_array($method, [Request::METHOD_POST, Request::METHOD_PUT])) {
            return;
        }

        if (!$entity->getHash()) {
            $entity->setHash(bin2hex(random_bytes(20)));
        }
    }
}