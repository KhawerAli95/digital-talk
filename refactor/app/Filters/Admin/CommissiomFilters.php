<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;

class CommissiomFilters extends Filters
{

    protected $filters = ['sortBy', 'user_type', 'rate_type'];


    public function sortBy($value)
    {
        $this->builder->when(request()->filled('sortBy') && request('sortBy') == 'effective_date', function ($q) use ($value) {
            $q->where('effective_date', '<=', $value);
        });

        $this->builder->when(request()->filled('sortBy') && request('sortBy') == 'updated_date', function ($q) use ($value) {
            $q->where('created_at', '<=', $value);
        });
    }

    public function user_type($value)
    {
        $this->builder->when(request()->filled('user_type'), function ($q) use ($value) {
            $q->where('user_type', $value);
        });
    }

    public function rate_type($value)
    {
        $this->builder->when(request()->filled('rate_type'), function ($q) use ($value) {
            $q->where('rate_type', $value);
        });
    }
}
