<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;

class UsersFilters extends Filters
{

    protected $filters = ['status', 'fromDate', 'toDate', 'search'];

    public function status($value)
    {
        $this->builder->where("status", $value);
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

    public function search($value)
    {
        $this->builder->when(request()->filled('search'), function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        });
    }
}
