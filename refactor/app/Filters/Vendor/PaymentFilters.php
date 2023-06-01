<?php

namespace App\Filters\Vendor;
use App\Core\Abstracts\Filters;

class PaymentFilters extends Filters {

    protected $filters = ['search','personal'];

    public function search($value)
    {
        $this->builder
        ->whereIn('payable_id',function($q) use($value){
            $q->select('id')
            ->from('orders')
            ->where('id','like','%'.$value.'%');
        });
    }

    public function personal($value)
    {
        $type = get_class($value);
        $id = $value->id;
        $this->builder
        ->whereIn('payable_id',function($q) use($type,$id){
            $q->select('id')
            ->from('orders')
            ->where('order_owner_type',$type)
            ->where('order_owner_id',$id);
        });        
    }
}
