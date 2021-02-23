<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJalurAPIRequest;
use App\Http\Requests\API\UpdateJalurAPIRequest;
use App\Models\Jalur;
use App\Repositories\JalurRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class JalurController
 * @package App\Http\Controllers\API
 */

class JalurAPIController extends AppBaseController
{
    /** @var  JalurRepository */
    private $jalurRepository;

    public function __construct(JalurRepository $jalurRepo)
    {
        $this->jalurRepository = $jalurRepo;
    }

    /**
     * Display a listing of the Jalur.
     * GET|HEAD /jalurs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $jalurs = Jalur::with(['jalur_partisipasi' => function ($query) {
            // user_id is required here*
            $query->select(['id as jalur_partisipasi_id', 'jalur_id', 'participate']);
        }])->get();

        return $this->sendResponse($jalurs->toArray(), 'Jalurs retrieved successfully');
    }

    /**
     * Store a newly created Jalur in storage.
     * POST /jalurs
     *
     * @param CreateJalurAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJalurAPIRequest $request)
    {
        $input = $request->all();

        $jalur = $this->jalurRepository->create($input);

        return $this->sendResponse($jalur->toArray(), 'Jalur saved successfully');
    }

    /**
     * Display the specified Jalur.
     * GET|HEAD /jalurs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Jalur $jalur */
        $jalur = $this->jalurRepository->find($id);

        if (empty($jalur)) {
            return $this->sendError('Jalur not found');
        }

        return $this->sendResponse($jalur->toArray(), 'Jalur retrieved successfully');
    }

    /**
     * Update the specified Jalur in storage.
     * PUT/PATCH /jalurs/{id}
     *
     * @param int $id
     * @param UpdateJalurAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJalurAPIRequest $request)
    {
        $input = $request->all();

        /** @var Jalur $jalur */
        $jalur = $this->jalurRepository->find($id);

        if (empty($jalur)) {
            return $this->sendError('Jalur not found');
        }

        $jalur = $this->jalurRepository->update($input, $id);

        return $this->sendResponse($jalur->toArray(), 'Jalur updated successfully');
    }

    /**
     * Remove the specified Jalur from storage.
     * DELETE /jalurs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Jalur $jalur */
        $jalur = $this->jalurRepository->find($id);

        if (empty($jalur)) {
            return $this->sendError('Jalur not found');
        }

        $jalur->delete();

        return $this->sendSuccess('Jalur deleted successfully');
    }
}
