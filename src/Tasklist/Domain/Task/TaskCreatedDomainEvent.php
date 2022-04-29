<?php

namespace TodoList\Api\Tasklist\Domain\Task;


use TodoList\Api\Shared\Domain\DomainEvent;
use TodoList\Api\Infrastructure\Api\Bus\Event\AsyncEvent;

class TaskCreatedDomainEvent extends DomainEvent implements AsyncEvent
{
    private string $id;
    private string $title;
    private string $assignDate;

    public function __construct(
        string $id,
        string $title,
        string $assignDate,
        string $eventId = null,
        string $eventDate = null
    ) {
        parent::__construct($id, $eventId, $assignDate);
    }
    
    public static function fromPrimitives(string $aggregateId, array $data, string $eventId, string $eventDate): self
    {
        return new self(
            $aggregateId,
            $data[Task::TITLE],
            $data[Task::ASSIGN_DATE],
            $eventId,
            $eventDate
        );
    }
    
    public function toPrimitives(): array
    {
        return [
            Task::ID => $this->id,
            Task::TITLE => $this->title,
            Task::ASSIGN_DATE => $this->assignDate,
        ];
    }
    
    public function getId(): string
    {
        return $this->id;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
    
    public function getAssignDate(): string
    {
        return $this->assignDate;
    }
    
    public static function eventName(): string
    {
        // @todo
        return '';
    }
}