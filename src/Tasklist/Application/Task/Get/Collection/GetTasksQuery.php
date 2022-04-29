<?php

namespace TodoList\Api\Tasklist\Application\Task\Get\Collection;


use TodoList\Api\Infrastructure\Api\Bus\Query\SyncQuery;

class GetTasksQuery implements SyncQuery
{
    private int $page;
    private int $size;
    private array $fields;
    private array $filters;
    private array $sort;

    public function __construct(int $page, int $size, array $fields, array $filters, array $sort)
    {
        $this->page = $page;
        $this->size = $size;
        $this->fields = $fields;
        $this->filters = $filters;
        $this->sort = $sort;
    }
    
    public function getPage(): int
    {
        return $this->page;
    }
    
    public function getSize(): int
    {
        return $this->size;
    }
    
    public function getFilters(): array
    {
        return $this->filters;
    }
    
    public function getFields(): array
    {
        return $this->fields;
    }
    
    public function getSort(): array
    {
        return $this->sort;
    }
}