<?php

namespace TodoList\Api\Tasklist\Application\Task;


use Doctrine\Common\Collections\Criteria as CriteriaDoctrine;
use Doctrine\Common\Collections\Expr\Expression;

class Criteria
{
    private CriteriaDoctrine $criteria;
    private ?string $alias = 't';

    public function __construct(
        array $exp,
        array $sort,
        int $page,
        int $size,
        ?string $alias = 't'
    ) {
        $this->criteria = new CriteriaDoctrine(
            $this->buildExp($exp),
            $this->buildSort($sort),
            (($page - 1) * $size),
            $size
        );
    }

    private function buildExp(array $exp): ?Expression
    {
        if ($exp === []) {
            return null;
        }
        
        // @todo filters here
        return CriteriaDoctrine::expr()?->contains('', []);
    }

    private function buildSort(array $sort): array
    {
        $results = [];
        
        foreach ($sort as $field) {
            $order = ($field[0] === '-' ? CriteriaDoctrine::DESC : CriteriaDoctrine::ASC);
            $name = ($field[0] === '-' ? substr($field, 1, strlen($field)) : $field);
            $results[$name] = $order;
        }
        
        return $results;
    }

    public function getCriteria(): CriteriaDoctrine
    {
        return $this->criteria;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }
}