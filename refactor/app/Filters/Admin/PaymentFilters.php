<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;
use App\Models\Order;

class PaymentFilters extends Filters
{

    protected $filters = ['search', 'personal', 'fromDate', 'toDate', 'order','type'];

    public function order($value)
    {
        $this->builder->orderBy($value['key'], $value['value']);
    }
    public function fromDate($value)
    {
        $this->builder->whereDate('created_at','>=', $value);
    }
    public function toDate($value)
    {
        $this->builder->whereDate('created_at','<=', $value);
    }
    public function search($value)
    {
        if($this->request->filled('type')){
            $typeValue = $this->request->type;
            if($typeValue == 'campaign'){
                $this->builder->where('payable_type',$typeValue)
                ->whereIn('payable_id',function($q) use($value){
                        $q->select('id')->from('campaigns')
                        ->where('name','like','%'.$value.'%')
                        ->orWhereIn('owner_id',function($q) use($value){
                            $q->select('id')->from('shelters')->where('name','like','%'.$value.'%');
                        });
                }); 
                return;
            }
            list(,$payableType) = explode('_',$typeValue);

            $this->builder
            ->where('payable_type', Order::class)
            ->whereIn('payable_id',function($q) use($payableType,$value){
                $q->select('id')->from('orders')->where('type',$payableType)
                ->where(function($q) use($value){
                    $q->where('id','like','%'.$value.'%');
                });
            });
            
        }else{

            $this->builder
            ->whereIn('payable_id', function ($q) use ($value) {
                $q->select('id')
                ->from('orders')
                ->where('id', 'like', '%' . $value . '%');
            });
        }
    }


    public function personal($value)
    {
        $type = get_class($value);
        $id = $value->id;
        $this->builder
            ->whereIn('payable_id', function ($q) use ($type, $id) {
                $q->select('id')
                    ->from('orders')
                    ->where('order_owner_type', $type)
                    ->where('order_owner_id', $id);
            });
    }

    public function type($value){
        
        if($value == 'campaign'){
            $this->builder->where('payable_type',$value); 
            return;
        }   
        list(,$payableType) = explode('_',$value);
        $this->builder
        ->where('payable_type', Order::class)
        ->whereIn('payable_id',function($q) use($payableType){
                $q->select('id')->from('orders')->where('type',$payableType);
        });
    }
}
