<?php

namespace App\Filters\Api;
use App\Core\Abstracts\Filters;

class NotificationFilters extends Filters {

    protected $filters = ['personal'];

    public function personal($value)
    {
        $type = get_class($value);
        $id = $value->id;
        $this->builder->where("notifiable_type", $type)
        ->where('notifiable_id',$id);
    }
}
