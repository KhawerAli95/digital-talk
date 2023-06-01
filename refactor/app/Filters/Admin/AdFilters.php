<?php

namespace App\Filters\Admin;

use App\Core\Abstracts\Filters;
use App\Repositories\Pet\PetRepository;

class AdFilters extends Filters
{

    protected $filters = ['search','type', 'personal', 'gender', 'color', 'category_id', 'breed', 'group', 'order', 'search', 'owner_id', 'status', 'inventory_status'];



    public function type($value)
    {
        if ($value == 'featured') {
            $this->builder->where("is_featured", 1)
                ->whereIn(
                    'id',
                    fn ($q) =>
                    $q->select('ad_id')->from('campaigns')
                        ->where('type', $value)
                        ->where('expired_at', '>=', now())
                );
        }
        if ($value == 'promotion') {
            $this->builder
                ->where('type', $value)
                ->where('expired_at', '>=', now());
        }
    }

    public function order($value)
    {

        $this->builder->orderBy($value['key'], $value['value']);
    }


    public function group($value)
    {
        $this->builder->where('group_id', $value);
    }
    public function status($value)
    {
        $this->builder->where('status', $value);
    }
    public function inventory_status($value)
    {
        $this->builder->where('status', $value);
    }


    public function breed($value)
    {
        $this->builder->where('breed_id', $value);
    }

    public function category_id($value)
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


    public function search($value)
    {
        if ($this->request->type == 'featured') {
            $this->builder
                ->whereIn('id', function ($q) use ($value) {
                    $q->select('ad_id')->from('campaigns')
                        ->whereIn('owner_id', function ($q) use ($value) {
                            $q->select('id')->from('shelters')->where('name', 'like', '%' . $value . '%');
                        })
                        ->orwhere('name', 'like', '%' . $value . '%')
                        ->orWhere('duration', 'like', '%' . $value . '%')
                        ->orWhere('cost', 'like', '%' . $value . '%')
                        ->orWhere('status', 'like', '%' . $value . '%');
                });
        }
        if ($this->request->type == 'promotion') {
            $this->builder
                ->where(function ($q) use ($value) {
                    $q
                        ->whereIn('owner_id', function ($q) use ($value) {
                            $q->select('id')->from('shelters')->where('name', 'like', '%' . $value . '%');
                        })
                        ->orwhere('name', 'like', '%' . $value . '%')
                        ->orWhere('duration', 'like', '%' . $value . '%')
                        ->orWhere('cost', 'like', '%' . $value . '%')
                        ->orWhere('status', 'like', '%' . $value . '%');
                });
        }

        if(!in_array($this->request->type,['promotion','featured'])){
            
            $this->builder
            ->where(function ($q) use ($value) {
                    $q
                        ->whereIn('category_id', function ($q) use ($value) {
                            $q->select('id')->from('categories')
                            ->where('name', 'like', '%' . $value . '%')->whereIn('type',['other_pet','pet']);
                        })
                        ->orWhere('name', 'like', '%' . $value . '%');
            });
        }
    }

    public function owner_id($value)
    {
        $this->builder->where('owner_id', $value);
    }
}
