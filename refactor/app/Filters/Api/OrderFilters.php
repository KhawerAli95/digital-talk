<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class OrderFilters extends Filters {

    protected $filters = ['personal','type','status'];

    public function status($value)
    {
        $this->builder->where("status", $value);
    }

    public function personal($value)
    {
        $this->builder->where("user_id", $value);
    }

    public function type($value)
    {
        $this->builder->where("type", $value);
    }

}
