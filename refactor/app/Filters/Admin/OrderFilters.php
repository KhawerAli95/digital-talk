<?php

namespace App\Filters\Admin;
use App\Core\Abstracts\Filters;

class OrderFilters extends Filters {

    protected $filters = ['search','owner_id','owner_type','fromDate','toDate','type'];

    public function owner_id($value)
    {
        $this->builder
        ->where('order_owner_id',$value);
    }

    public function search($value)
    {
        $this->builder->where("id",'like','%'.$value.'%')
        ->orWhere("contact_detail->first_name",'like','%'.$value.'%')
        ->orWhere("contact_detail->last_name",'like','%'.$value.'%');
    }

    public function fromDate($value)
    {
        $this->builder->whereDate('created_at','>=', $value);
       
    }
    public function toDate($value)
    {
        $this->builder->whereDate('created_at','<=', $value);
    }

    public function owner_type($value)
    {
        $this->builder
        ->where('order_owner_type','App\Models\\'.\Str::studly($value));
    }

    public function type($value)
    {
        $this->builder
        ->where('type',$value);
    }
}
