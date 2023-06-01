<?php

namespace App\Http\Controllers\Admin\Shelter;

use App\Models\Ad;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Filters\Admin\AdFilters;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Filters\Admin\ShelterFilters;
use App\Repositories\Pet\PetRepository;
use App\Repositories\Shelter\ShelterRepository;

class ShelterController extends Controller
{
    private ShelterRepository $shelter;
    private PetRepository $petRepo;

    public function __construct(ShelterRepository $shelterRepo, Shelter $shelter, PetRepository $petRepo, Ad $ads)
    {
        $this->shelter = $shelterRepo;
        $this->shelter->setModel($shelter);

        $this->ads = $petRepo;
        $this->ads->setModel($ads);
    }

    public function index(Request $request, ShelterFilters $filter): JsonResponse
    {
        try {

            $shelterListing = $this->shelter->paginate(
                request('per_page', 10),
                filter: $filter,
            );
            $data = api_successWithData('shelter listing', $shelterListing);
            return response()->json($data);
        } catch (\Exception $e) {

            $data = api_error($e->getMessage());
            return response()->json($data);
        }
    }

    public function show($id): JsonResponse
    {
        try {

            $user = $this->shelter->findById(
                $id,
                relations: ['file']
            );

            $data = api_successWithData('shelter data', $user);
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            $data = api_error($e->getMessage());
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateStatus($id)
    {
        try {

            $this->shelter->updateStatus($id);
            $data = api_success('shelter status has been updated');
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            $data = api_error($e->getMessage());
            return response()->json($data, Response::HTTP_CONFLICT);
        }
    }

    public function ads(Request $request, AdFilters $filter): JsonResponse
    {
        try {

            try {
                $filter->extendRequest([
                    'owner_id' => request('id'), request()->user()->id
                ]);

                $adsListing = $this->ads->paginate(
                    request('per_page', 10),
                    filter: $filter,
                    relations: ['category']
                );
                $data = api_successWithData('shelter ads listing', $adsListing);
                return response()->json($data);
            } catch (\Exception $e) {

                $data = api_error($e->getMessage());
                return response()->json($data);
            }
        } catch (\Exception $e) {
            $data = api_error($e->getMessage());
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showAds($id): JsonResponse
    {
        try {

            $user = $this->ads->findById(
                $id,
                relations: ['file']
            );

            $data = api_successWithData('shelter data', $user);
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            $data = api_error($e->getMessage());
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
