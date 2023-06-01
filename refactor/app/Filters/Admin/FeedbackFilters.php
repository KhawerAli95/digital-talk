<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;

class FeedbackFilters extends Filters
{

    protected $filters = ['fromDate', 'toDate', 'search', 'type'];


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
            $q->where('name', 'like', '%' . $value . '%');
        });
    }
    public function type($value)
    {
        $this->builder->when(request()->filled('type'), function ($q) use ($value) {
            $q->where('user_type', $value);
        });
    }
}
