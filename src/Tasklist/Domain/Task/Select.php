<?php

namespace TodoList\Api\Tasklist\Domain\Task;


class Select
{
    private array $fields;
    private ?string $alias = 't';
    private ?bool $fetchArray = false;

    public function __construct(array $fields, ?string $alias = 't', ?bool $fetchArray = false)
    {
        $this->fields = $fields;
        $this->alias = $alias;
        $this->fetchArray = $fetchArray;
    }
    
    public function getFields(): ?string
    {
        $alias = $this->alias;
        
        if (!$this->fetchArray) {
            return $alias;
        }
        
        return implode(',', array_map(static function ($field) use ($alias) {
            return "$alias.$field";
        }, $this->fields));
    }
    
    public function getFetchArray(): ?bool
    {
        return $this->fetchArray;
    }
}