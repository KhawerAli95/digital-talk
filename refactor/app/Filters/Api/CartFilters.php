<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class CartFilters extends Filters {

    protected $filters = ['personal'];

    public function personal($value)
    {
        $this->builder->where("user_id", $value);
    }

    
}
