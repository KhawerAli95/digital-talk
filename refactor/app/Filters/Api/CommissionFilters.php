<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class CommissionFilters extends Filters {

    protected $filters = ['search','rate_type','user_type'];

    public function search($value)
    {
        $this->builder->where("status", $value);
    }

    public function rate_type($value)
    {
        $this->builder->where("rate_type", $value);
    }

    public function user_type($value)
    {
        $this->builder->where("user_type", $value);
    }

    public function order($value)
    {
        $this->builder->latest('id');
    }

    public function effective_date($value)
    {
        $this->builder->whereDate("effective_date",'<=',$value);
    }
}
