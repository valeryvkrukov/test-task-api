<?php

namespace TodoList\Api\Tasklist\Domain\Worker;


use TodoList\Api\Tasklist\Application\Task\TaskAssembler;
use TodoList\Api\Tasklist\Domain\Task\Task;
use TodoList\Api\Tasklist\Domain\Task\TaskCollection;
use TodoList\Api\Shared\Domain\Worker\WorkerId;

class Worker implements \Stringable
{
    public const ID = 'id';
    public const NAME = 'name';

    private WorkerId $id;
    private WorkerName $name;
    private WorkerAddingDate $addingDate;
    private TaskCollection $tasks;

    public function __construct(WorkerId $id, WorkerName $name, TaskCollection $tasks)
    {
        $this->id = $id;
        $this->name = $name;
        $this->tasks = $tasks;
        $this->addingDate = new WorkerAddingDate([]);
    }

    public static function fromPrimitives($primitiveData): Worker
    {
        $tasks = [];

        foreach ($primitiveData['task'] as $task) {
            $tasks[] = TaskAssembler::fromEntityToArray($task);
        }

        return new Worker(
            new WorkerId($primitiveData['id']),
            new WorkerName($primitiveData['name']),
            new TaskCollection($tasks)
        );
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'adding_date' => $this->addingDate->value()->format(WorkerAddingDate::FORMAT),
        ];
    }

    public function update(WorkerName $name): void
    {
        $this->name = $name;
    }

    public function addTask(Task $task): void
    {
        $this->tasks->add($task);
    }

    public function deleteTask(Task $task): void
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->delete($task);
        }
    }

    public function __toString(): string
    {
        return $this::class . ':' . $this->id->value();
    }
}