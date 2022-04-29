<?php

namespace TodoList\Api\Tasklist\Domain\Task;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use TodoList\Api\Tasklist\Domain\Task\ValueObject\TaskAssignDate;
use TodoList\Api\Tasklist\Domain\Task\ValueObject\TaskTitle;
use TodoList\Api\Tasklist\Domain\Worker\Worker;
use TodoList\Api\Shared\Domain\Aggregate;
use TodoList\Api\Shared\Domain\Task\TaskId;
use TodoList\Api\Shared\Domain\DomainEvent;

class Task extends Aggregate implements \Stringable
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const ASSIGN_DATE = 'assignDate';
    public const DATE_FORMAT = 'Y-m-d H:i:s';

    private TaskId $id;
    private TaskTitle $title;
    private TaskAssignDate $assignDate;
    private Collection $workers;

    private function __construct(TaskId $id, TaskTitle $title, TaskAssignDate $assignDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->assignDate = $assignDate;
        $this->workers = new ArrayCollection();

        $this->collectEvent(
            new AlbumCreatedDomainEvent(
                $id->value(),
                $title->value(),
                $releaseDate->value(),
                null,
                (new DateTime())->format(DomainEvent::$dateFormat)
            )
        );
    }

    public static function create(TaskId $id, TaskTitle $title, TaskAssignDate $assignDate): Task
    {
        return new self($id, $title, $assignDate);
    }

    public function getId(): TaskId
    {
        return $this->id;
    }
    
    public function getTitle(): TaskTitle
    {
        return $this->title;
    }
    
    public function getAssignDate(): TaskAssignDate
    {
        return $this->assignDate;
    }

    public static function getFieldNames(): array
    {
        return [
            self::ID,
            self::TITLE,
            self::ASSIGN_DATE,
        ];
    }

    public function update(?TaskTitle $title, ?TaskAssignDate $assignDate): void
    {
        $this->title = $title ?: $this->title;
        $this->assignDate = $assignDate ?: $this->assignDate;
    }

    public function addWorker(Worker $worker): void
    {
        $worker->addTask($this);
        $this->workers->add($worker);
    }

    public function deleteWorker(Worker $worker): void
    {
        if ($this->workers->contains($worker)) {
            $this->workers->removeElement($worker);
        }
    }

    public function equals(self $task): bool
    {
        return
            $this->id->value() === $task->id->value() &&
            $this->title->value() === $task->title->value() &&
            $this->assignDate->value() === $task->assignDate->value();
    }

    public function __toString(): string
    {
        return substr(strrchr($this::class, '\\'), 1) . ':' . $this->id->value();
    }
}