<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;

class PlanFilters extends Filters
{

    protected $filters = ['fromDate', 'toDate', 'search', 'type', 'status', 'duration'];


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

    public function search($value)
    {
        $this->builder->when(request()->filled('search'), function ($q) use ($value) {
            $q->where('cost', 'like', '%' . $value . '%');
        });
    }
    public function type($value)
    {
        $this->builder->when(request()->filled('type'), function ($q) use ($value) {
            $q->where('type', $value);
        });
    }

    public function status($value)
    {
        $this->builder->when(request()->filled('status'), function ($q) use ($value) {
            $q->where('status', $value);
        });
    }

    public function duration($value)
    {
        $this->builder->when(request()->filled('duration'), function ($q) use ($value) {
            $q->where('duration', $value);
        });
    }
}
