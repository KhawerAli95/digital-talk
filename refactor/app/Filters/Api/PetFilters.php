<?php

namespace App\Filters\Api;

use App\Core\Abstracts\Filters;

class PetFilters extends Filters
{

    protected $filters = ['type', 'order', 'group', 'category', 'color', 'gender', 'personal'];

    public function order($value)
    {
        $this->builder->orderBy($value['key'], $value['value']);
    }
    public function type($value)
    {
        $this->builder->where('type', $value);
    }

    public function group($value)
    {
        $this->builder->where('group_id', $value);
    }

    public function category($value)
    {
        $this->builder->where('category_id', $value);
    }

    public function color($value)
    {
        $this->builder->where('color', $value);
    }

    public function gender($value)
    {
        $this->builder->where('gender', $value);
    }

    public function personal($value)
    {
        $user = request()->user();
        $type = get_class($user);
        $id = $user->id;

        $this->builder
            ->where('owner_type', $type)
            ->where('owner_id', $id);
    }
}
