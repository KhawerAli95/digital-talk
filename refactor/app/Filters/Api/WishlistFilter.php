<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class WishlistFilter extends Filters {

    protected $filters = ['personal'];

    public function type($value)
    {
        $this->builder->where("type", $value);
    }

    public function personal($value)
    {
        $this->builder->where("user_id", $value);
    }
}
