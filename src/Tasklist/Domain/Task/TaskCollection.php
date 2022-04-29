<?php

namespace TodoList\Api\Tasklist\Domain\Task;


class TaskCollection implements \IteratorAggregate
{
    private int $size;
    private array $tasks;

    public function __construct(array $tasks)
    {
        $this->tasks = $tasks;
        $this->size = count($tasks);
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function add(Task $task): void
    {
        $this->albums[spl_object_hash($task)] = $task;
    }

    public function delete(Task $task): void
    {
        if ($this->contains($task)) {
            unset($this->tasks[spl_object_hash($task)]);
        }
    }

    public function contains(Task $task): bool
    {
        return isset($this->tasks[spl_object_hash($task)]);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->tasks);
    }

    public function size(): int
    {
        return $this->size;
    }
}