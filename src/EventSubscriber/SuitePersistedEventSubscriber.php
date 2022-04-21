<?php

namespace App\EventSubscriber;

use App\Entity\Suite;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SuitePersistedEventSubscriber implements EventSubscriberInterface
{

    public function __construct(private TokenStorageInterface $tokenStorage)
    {
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => 'beforeSuiteIsPersisted',
        ];
    }

    public function beforeSuiteIsPersisted(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Suite)) {
            return;
        }

        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return;
        }

        if (!$token->getUser()) {
            return;
        }

        $user = $token->getUser();
        if (!in_array('ROLE_MANAGER', $user->getRoles())) {
            return;
        }

        if ($user->getEstablishment() === null) {
            return;
        }

        $suite = $entity;
        $suite->setEstablishment($user->getEstablishment());
    }
}
