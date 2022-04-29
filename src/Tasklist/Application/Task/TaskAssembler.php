<?php

namespace TodoList\Api\Tasklist\Application\Task;


use TodoList\Api\Tasklist\Domain\Task\Task;
use TodoList\Api\Tasklist\Domain\Task\ValueObject\TaskAssignDate;
use TodoList\Api\Tasklist\Domain\Task\ValueObject\TaskTitle;
use TodoList\Api\Shared\Domain\Task\TaskId;

class TaskAssembler
{
    public static array $jsonMappingToEntity = [
        'id' => Task::ID,
        'title' => Task::TITLE,
        'assign_date' => Task::ASSIGN_DATE,
    ];

    public static function fromEntityToArray(?Task $task): array
    {
        return ($task !== null) ? [
            Task::ID => $task->getId(),
            Task::TITLE => $task->getTitle(),
            Task::ASSIGN_DATE => $task->getAssignDate(),
        ] : [];
    }

    public static function fromEntityToArrayPrimitives(?Task $task): array
    {
        return ($task !== null) ? [
            Task::ID => $task->getId()->value(),
            Task::TITLE => $task->getTitle()->value(),
            Task::ASSIGN_DATE => $task->getAssignDate()->value(),
        ] : [];
    }

    public static function fromArrayPrimitivesToEntity(array $taskArray): Task
    {
        return Task::create(
            id: new TaskId($taskArray[Task::ID]),
            title: new TaskTitle($taskArray[Task::TITLE]),
            assignDate: new TaskAssignDate($taskArray[Task::ASSIGN_DATE]),
        );
    }

    public static function fromArrayToResponse(array $taskArray): array
    {
        $result = [];
        
        if (isset($taskArray[Task::ID])) {
            $result['id'] = $taskArray[Task::ID]->value();
        }

        if (isset($taskArray[Task::TITLE])) {
            $result['title'] = $taskArray[Task::TITLE]->value();
        }

        if (isset($taskArray[Task::ASSIGN_DATE])) {
            $result['assign_date'] = $taskArray[Task::ASSIGN_DATE]->value();
        }
        
        return $result;
    }

    public static function fromEntityToResponse(Task $task): array
    {
        return [
            'id' => $task->getId()->value(),
            'title' => $task->getTitle()->value(),
            'assign_date' => $task->getAssignDate()->value(),
        ];
    }
}