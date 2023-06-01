<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class ReviewFilters extends Filters {

    protected $filters = ['product_id','order'];

    public function product_id($value)
    {
        $this->builder->where("product_id", $value);
    }

    public function order($value)
    {
        $this->builder->orderBy($value['key'], $value['value']);
    }
}
