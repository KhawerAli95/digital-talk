<?php

namespace App\Filters\Admin;
use App\Core\Abstracts\Filters;

class AdoptionFilters extends Filters {

    protected $filters = ['search'];

    public function search($value)
    {
        $this->builder->where(function($q) use($value){
            $q->where("id", 'like','%'.$value.'%');
        });
    }
}
