<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class ShelterFilters extends Filters {

    protected $filters = ['search'];

    public function search($value)
    {
        $this->builder->where("status", $value);
    }
}
