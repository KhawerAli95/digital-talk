<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class ProductFilters extends Filters {

    protected $filters = ['search'];

    public function vendor_id($value)
    {
        $this->builder->where("vendor_id", $value);
    }

    public function category_id($value)
    {
        $this->builder->where("category_id", $value);
    }

    public function order($value)
    {
        $this->builder->where($value['key'], $value['value']);
    }

    public function distance($value)
    {
        $this->builder->where($value['key'], $value['value']);
    }
}
