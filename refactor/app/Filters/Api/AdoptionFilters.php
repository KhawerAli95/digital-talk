<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class AdoptionFilters extends Filters {

    protected $filters = ['pet_id','user_id'];

    public function pet_id($value)
    {
        $this->builder->where("pet_id", $value);
    }

    public function user_id($value)
    {
        $this->builder->where("user_id", $value);
    }

}
