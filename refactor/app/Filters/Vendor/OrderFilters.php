<?php

namespace App\Filters\Vendor;
use App\Core\Abstracts\Filters;

class OrderFilters extends Filters {

    protected $filters = ['search','vendor_id','personal'];

    public function search($value)
    {
        $this->builder->where("order_id",'like','%'.$value.'%')
        ->orWhere("contact_detail->first_name",'like','%'.$value.'%')
        ->orWhere("contact_detail->last_name",'like','%'.$value.'%');
    }


    public function personal($value)
    {
        $type = get_class($value);
        $id = $value->id;
        $this->builder
        ->where('order_owner_type',$type)
        ->where('order_owner_id',$id);
    }
}
