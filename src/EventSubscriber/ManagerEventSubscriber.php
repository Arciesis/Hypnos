<?php

namespace App\EventSubscriber;

use App\Entity\Manager;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityBuiltEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class ManagerEventSubscriber implements EventSubscriberInterface
{

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['persistManager'],
            /*AfterEntityBuiltEvent::class => ['createLinkedEstablishment']*/
        ];
    }

    public function persistManager(BeforeEntityPersistedEvent $event)
    {
        // dd($event);
        $entity =  $event->getEntityInstance();

        if (!($entity instanceof Manager)) {
            return;
        }

        $hashedPW = password_hash($entity->getPassword(),PASSWORD_BCRYPT);

        $entity->setPassword($hashedPW);
        $entity->setRoles(['ROLE_MANAGER']);
        // $entity->setEstablishment();
    }

    /*public function createLinkedEstablishment(AfterEntityBuiltEvent $event)
    {
        dd($event);

        //$entity->getFields()->get('')

    }*/
}
