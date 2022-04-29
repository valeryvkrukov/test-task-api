<?php

namespace TodoList\Api\Shared\Application\Service;


interface ApplicationService
{
    public function execute(Request $request): ?Response;
}