<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJalurPartisipasiAPIRequest;
use App\Http\Requests\API\UpdateJalurPartisipasiAPIRequest;
use App\Models\JalurPartisipasi;
use App\Repositories\JalurPartisipasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class JalurPartisipasiController
 * @package App\Http\Controllers\API
 */

class JalurPartisipasiAPIController extends AppBaseController
{
    /** @var  JalurPartisipasiRepository */
    private $jalurPartisipasiRepository;

    public function __construct(JalurPartisipasiRepository $jalurPartisipasiRepo)
    {
        $this->jalurPartisipasiRepository = $jalurPartisipasiRepo;
    }

    /**
     * Display a listing of the JalurPartisipasi.
     * GET|HEAD /jalurPartisipasis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $jalurPartisipasis = $this->jalurPartisipasiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($jalurPartisipasis->toArray(), 'Jalur Partisipasis retrieved successfully');
    }

    /**
     * Store a newly created JalurPartisipasi in storage.
     * POST /jalurPartisipasis
     *
     * @param CreateJalurPartisipasiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJalurPartisipasiAPIRequest $request)
    {
        $input = $request->all();

        $jalurPartisipasi = $this->jalurPartisipasiRepository->create($input);

        return $this->sendResponse($jalurPartisipasi->toArray(), 'Jalur Partisipasi saved successfully');
    }

    /**
     * Display the specified JalurPartisipasi.
     * GET|HEAD /jalurPartisipasis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var JalurPartisipasi $jalurPartisipasi */
        $jalurPartisipasi = $this->jalurPartisipasiRepository->find($id);

        if (empty($jalurPartisipasi)) {
            return $this->sendError('Jalur Partisipasi not found');
        }

        return $this->sendResponse($jalurPartisipasi->toArray(), 'Jalur Partisipasi retrieved successfully');
    }

    /**
     * Update the specified JalurPartisipasi in storage.
     * PUT/PATCH /jalurPartisipasis/{id}
     *
     * @param int $id
     * @param UpdateJalurPartisipasiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJalurPartisipasiAPIRequest $request)
    {
        $input = $request->all();

        /** @var JalurPartisipasi $jalurPartisipasi */
        $jalurPartisipasi = $this->jalurPartisipasiRepository->find($id);

        if (empty($jalurPartisipasi)) {
            return $this->sendError('Jalur Partisipasi not found');
        }

        $jalurPartisipasi = $this->jalurPartisipasiRepository->update($input, $id);

        return $this->sendResponse($jalurPartisipasi->toArray(), 'JalurPartisipasi updated successfully');
    }

    /**
     * Remove the specified JalurPartisipasi from storage.
     * DELETE /jalurPartisipasis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var JalurPartisipasi $jalurPartisipasi */
        $jalurPartisipasi = $this->jalurPartisipasiRepository->find($id);

        if (empty($jalurPartisipasi)) {
            return $this->sendError('Jalur Partisipasi not found');
        }

        $jalurPartisipasi->delete();

        return $this->sendSuccess('Jalur Partisipasi deleted successfully');
    }
}
