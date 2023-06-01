<?php

namespace App\Filters\Api;

use App\Core\Abstracts\Filters;

class CategoryFilters extends Filters
{

    protected $filters = ['type', 'status', 'search', 'fromDate', 'toDate',];

    public function type($value)
    {        
        if (in_array('pet', $value) || in_array('other_pet', $value)) {
            $this->builder->with(['breed_types']);
        }

        $this->builder->whereIn("type", $value);
    }


    public function status($value)
    {
        $this->builder->where("status", $value);
    }

    public function search($value)
    {
        $this->builder->when(request()->filled('search'), function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        });
    }

    public function fromDate($value)
    {
        $this->builder->when(request()->filled('fromDate'), function ($q) use ($value) {
            $q->whereDate('created_at', $value);
        });
    }
    public function toDate($value)
    {
        $this->builder->when(request()->filled('toDate'), function ($q) use ($value) {
            $q->whereDate('created_at', $value);
        });
    }
}
