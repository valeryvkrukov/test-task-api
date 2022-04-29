<?php

namespace TodoList\Api\Tasklist\Application\Task\Get\Collection;


use TodoList\Api\Tasklist\Application\Task\Criteria;
use TodoList\Api\Tasklist\Domain\Task\TaskRepository;
use TodoList\Api\Tasklist\Domain\Task\Select;
use TodoList\Api\Shared\Application\Service\ApplicationService;
use TodoList\Api\Shared\Application\Service\Request;

class TasksQuery implements ApplicationService
{
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetTasksQuery|Request $request): TasksResponse
    {
        $alias = 'task';
        
        $criteria = new Criteria(
            exp: $request->getFilters(), //@todo
            sort: $request->getSort(),
            page: $request->getPage(),
            size: $request->getSize(),
            alias: $alias
        );
        
        $select = new Select(
            fields: $request->getFields(),
            alias: $alias,
            fetchArray: true
        );
        
        $taskResultSet = $this->repository->getMatching(
            select: $select,
            criteria: $criteria
        );
        
        return new TasksResponse(
            tasks: $taskResultSet->getTasks(),
            total: $taskResultSet->getTotal(),
            page: $request->getPage(),
            size: $request->getSize()
        );
    }
}