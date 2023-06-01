<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;

class VendorFilters extends Filters
{

    protected $filters = ['status', 'fromDate', 'toDate', 'search', 'vendor_name'];

    public function status($value)
    {
        $this->builder->when(request()->filled('status') && request('status') == 'pending', function ($q) use ($value) {
            $q->where('approved', 0);
        });
        $this->builder->when(request()->filled('status') && request('status') == 'rejected', function ($q) use ($value) {
            $q->where('approved', 2);
        });
        $this->builder->when(request()->filled('status') && request('status') == 'active', function ($q) use ($value) {
            $q->where('status', 1);
        });
        $this->builder->when(request()->filled('status') && request('status') == 'inactive', function ($q) use ($value) {
            $q->where('status', 2);
        });
    }

    public function fromDate($value)
    {
        $this->builder->when(request()->filled('fromDate'), function ($q) use ($value) {
            $q->whereDate('created_at', '>=', $value);
        });
    }
    public function toDate($value)
    {
        $this->builder->when(request()->filled('toDate'), function ($q) use ($value) {
            $q->whereDate('created_at', '<=', $value);
        });
    }

    public function search($value)
    {
        $this->builder->when(request()->filled('search'), function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        });
    }

    public function vendor_name($value)
    {
        $this->builder->when(request()->filled('vendor_name'), function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        });
    }
}
