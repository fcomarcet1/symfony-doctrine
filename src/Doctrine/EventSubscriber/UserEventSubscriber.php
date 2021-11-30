<?php

declare(strict_types=1);

namespace App\Doctrine\EventSubscriber;

use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

class UserEventSubscriber implements EventSubscriber
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate,
        ];
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof User) {
            $this->logger->info(
                \sprintf('User has been updated. New name: %s UpdatedAt: %s', $entity->getName(), $entity->getUpdatedAt())
            );
        }
    }
}
