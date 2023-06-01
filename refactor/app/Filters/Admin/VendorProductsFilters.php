<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;

class VendorProductsFilters extends Filters
{

    protected $filters = ['status', 'sortBy', 'search', 'vendor_id'];

    public function status($value)
    {
        $this->builder->when(request()->filled('status'), function ($q) use ($value) {
            $q->where('status', $value);
        });
    }
    public function vendor_id($value)
    {

        $this->builder->where('vendor_id', $value);
    }

    public function search($value)
    {
        $this->builder->when(request()->filled('search'), function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        });
    }

    public function sortBy($value)
    {
        $this->builder->when(request()->filled('sortBy') && request('sortBy') == 'date', function ($q) use ($value) {
            $this->builder->orderBy('created_at', 'desc');
        });
        $this->builder->when(request()->filled('sortBy') && request('sortBy') == 'product', function ($q) use ($value) {
            $this->builder->orderBy('name', 'asc');
        });
    }
}
