<?php

namespace TodoList\Api\Tasklist\Domain\Worker;


interface WorkerRepository
{
    public function post(Worker $worker): void;
}