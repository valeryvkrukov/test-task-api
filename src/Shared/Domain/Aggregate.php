<?php

namespace TodoList\Api\Shared\Domain;


abstract class Aggregate
{
    private array $domainEvents = [];

    protected function collectEvent(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }

    public function dropEvents(): array
    {
        $domainEvents = $this->domainEvents;

        $this->domainEvents = [];

        return $domainEvents;
    }

    protected function countEvents(): int
    {
        return count($this->domainEvents);
    }
}