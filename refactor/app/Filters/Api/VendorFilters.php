<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class VendorFilters extends Filters {

    protected $filters = ['search','distance','order'];

    public function search($value)
    {
        $this->builder->where("name",'like', "%{$value}%");
    }
    public function order($value)
    {

        $this->builder->orderBy($value['key'], $value['value']);
    }

    public function distance($value)
    {
        // $this->builder->where($value['key'], $value['value']);
    }
}
