<?php


namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;

class SoftDeleteListener implements EventSubscriber
{
    public function preFlush(PreFlushEventArgs $event)
    {
        $em = $event->getEntityManager();
        foreach ($em->getUnitOfWork()->getScheduledEntityDeletions() as $object) {
            if (method_exists($object, "getDeletedAt")) {
                if ($object->getDeletedAt() instanceof \Datetime) {
                    continue;
                } else {
                    $object->setDeletedAt(new \DateTime());
                    $em->merge($object);
                    $em->persist($object);
                }
            }
        }
    }

    public function getSubscribedEvents()
    {
        return [Events::preFlush];
    }
}
