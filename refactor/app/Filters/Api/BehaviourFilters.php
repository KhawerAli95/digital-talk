<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class BehaviourFilters extends Filters {

    protected $filters = ['parent'];

    public function parent($value)
    {
        $this->builder->whereNull("parent");
    }
}
