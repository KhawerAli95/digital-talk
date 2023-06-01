<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;

class ShelterFilters extends Filters
{

    protected $filters = ['search', 'status'];

    public function search($value)
    {
        $this->builder->where('name', 'like', '%' . $value . '%');
    }
    public function status($value)
    {
        $this->builder->where("status", $value);
    }

    public function fromDate($value)
    {
        $this->builder->whereDate('created_at', '>=', $value);
    }
    public function toDate($value)
    {
        $this->builder->whereDate('created_at', '<=', $value);
    }
}
