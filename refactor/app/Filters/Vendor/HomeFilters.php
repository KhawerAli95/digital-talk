<?php

namespace App\Filters\Vendor;
use App\Core\Abstracts\Filters;
use App\Models\Commissions;

class HomeFilters extends Filters {

    protected $filters = ['order','payment','commission'];



    public function order($value)
    {
        $this->builder
        ->select([
            \DB::raw('MONTHNAME(created_at) as month'),
            \DB::raw('COUNT(*) as total'),
            
        ])
        // ->whereRaw('MONTH(created_at) = MONTH(NOW())')
        ->whereRaw('YEAR(created_at) = ?',['year'=> request('year',date('Y')) ])
        ->orderByRaw("FIELD(MONTH,'January','February','March','April','May','June','July','August','September','November','December')")
        ->groupBy('month');
    }

    public function payment($value)
    {
        $this->builder
        ->select([
            \DB::raw('MONTHNAME(created_at) as month'),
            \DB::raw('SUM(amount) as total'),            
        ])
        // ->whereRaw('MONTH(created_at) = MONTH(NOW())')
        ->whereRaw('YEAR(created_at) = ?',['year'=> request('year',date('Y')) ])
        ->orderByRaw("FIELD(MONTH,'January','February','March','April','May','June','July','August','September','November','December')")
        ->groupBy('month');
    }


    public function commission(){
        $this->builder
        ->withCount([
            'commission as commission' => fn($q)=> $q->select(\DB::raw('rate / 100')),
            'products as total' => fn($q) => $q->select(\DB::raw('SUM(price * qty)')),
            ])
            ->addSelect([ 
            \DB::raw('MONTHNAME(created_at) as month'),
            \DB::raw('(SELECT SUM(total * commission)) as total'),  
            
        ])
        ->whereRaw('YEAR(created_at) = ?',['year'=> request('year',date('Y')) ])
        ->orderByRaw("FIELD(MONTH,'January','February','March','April','May','June','July','August','September','November','December')");
        // ->groupBy('month');
    }
}
