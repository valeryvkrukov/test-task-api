<?php

namespace TodoList\Api\Tasklist\Application\Task\Get\Collection;


use TodoList\Api\Tasklist\Domain\Task\Task;
use TodoList\Api\Shared\Application\Service\Response;

class TasksResponse implements Response
{
    private array $tasks;
    private int $total;
    private int $page;
    private int $size;

    public function __construct(array $tasks, int $total, int $page, int $size)
    {
        $this->tasks = $tasks;
        $this->total = $total;
        $this->page = $page;
        $this->size = $size;
    }

    public function toJson(): string
    {
        return json_encode([
            'data' => $this->getData(),
            'links' => $this->getLinks(),
            'meta'  => $this->getMeta()
        ], JSON_THROW_ON_ERROR);
    }

    private function getData(): array
    {
        return $this->tasks;
    }

    private function getLinks(): array
    {
        if ($this->total === 0) {
            return [];
        }
        
        $self = $this->page;
        $size = $this->size;
        $first = 1;
        $last = ceil($this->total / $this->size);
        $prev = ceil((($self - 1) <= $first) ? $first : $self - 1);
        $next  = ceil((($self + 1) >= $last) ? $last : $self + 1);
        
        $url = str_replace(
            ['[', ']'], 
            ['%%5B', '%%5D'],
            '/tasks?page[number]=%s&page[size]=%s'
        );
        
        return [
            'self' => sprintf($url, $self, $size),
            'first' => sprintf($url, $first, $size),
            'last' => sprintf($url, $last, $size),
            'prev' => sprintf($url, $prev, $size),
            'next' => sprintf($url, $next, $size),
        ];
    }

    private function getMeta(): array
    {
        return ['total_pages' => ceil($this->total / $this->size)];
    }
}