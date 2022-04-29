<?php

namespace TodoList\Api\Tasklist\Domain\Worker;


use Doctrine\Common\Collections\ArrayCollection;

class WorkerCollection extends ArrayCollection
{
    public function toPrimitives(): array
    {
        $primitives = [];
        
        foreach ($this->getValues() as $worker) {
            $primitives[] = $worker->toPrimitives();
        }

        return $primitives;
    }
}