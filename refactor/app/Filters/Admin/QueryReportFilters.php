<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;

class QueryReportFilters extends Filters
{

    protected $filters = ['fromDate', 'toDate', 'search', 'type'];


    public function fromDate($value)
    {
        $this->builder->whereDate('created_at', $value);
    }
    public function toDate($value)
    {
        $this->builder->whereDate('created_at', $value);
    }

    public function search($value)
    {
        $this->builder->where(function($q) use($value){
            $q->whereIn('user_id',function($q) use($value){
                $q->select('id')->from('users')
                ->where('name', 'like', '%' . $value . '%')
                ->orWhere('email', 'like', '%' . $value . '%');
            })
            ->orWhere('reportable_type', 'like', '%' . $value . '%');
        });
    }
    public function type($value)
    {
        list($reportableValue,$reportable_type) = explode('_',$value);

        $this->builder->where('reportable_type', $reportable_type)
        ->when($reportable_type == 'ad',function($q)use($reportableValue){
            $q->whereIn('reportable_id',function($q) use($reportableValue){
                $q->select('id')->from('ads')->where('type',$reportableValue);
            });
        })->when($reportable_type == 'order',function($q)use($reportableValue){
            $q->whereIn('reportable_id',function($q) use($reportableValue){
                $q->select('id')->from('orders')->where('type',$reportableValue);
            });
        });
    }
}
