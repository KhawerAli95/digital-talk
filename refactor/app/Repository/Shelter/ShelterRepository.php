<?php

namespace App\Repositories\Shelter;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use App\Core\Abstracts\Repository\BaseRepository;
use App\Models\Shelter;
use App\Repositories\Shelter\ShelterRepositoryContract;

class ShelterRepository extends BaseRepository implements ShelterRepositoryContract
{

    protected $model;

    public function setModel(Model $model)
    {
        $this->model = $model;
        $this->shelter = new Shelter();
    }

    public function updateStatus($id)
    {

        try {

            $shelter = $this->shelter->find(
                $id,
            );
            $shelter->update(['status' => $shelter->status == 0 ? 1 : 0]);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
