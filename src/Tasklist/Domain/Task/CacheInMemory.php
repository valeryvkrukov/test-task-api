<?php

namespace TodoList\Api\Tasklist\Domain\Task;


interface CacheInMemory
{
    public function get($key);
    
    public function set($key, $value, $timeout = null);
    
    public function del(...$keys);
}