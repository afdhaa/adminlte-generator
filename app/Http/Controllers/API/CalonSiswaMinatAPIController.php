<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCalonSiswaMinatAPIRequest;
use App\Http\Requests\API\UpdateCalonSiswaMinatAPIRequest;
use App\Models\CalonSiswaMinat;
use App\Repositories\CalonSiswaMinatRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CalonSiswaMinatController
 * @package App\Http\Controllers\API
 */

class CalonSiswaMinatAPIController extends AppBaseController
{
    /** @var  CalonSiswaMinatRepository */
    private $calonSiswaMinatRepository;

    public function __construct(CalonSiswaMinatRepository $calonSiswaMinatRepo)
    {
        $this->calonSiswaMinatRepository = $calonSiswaMinatRepo;
    }

    /**
     * Display a listing of the CalonSiswaMinat.
     * GET|HEAD /calonSiswaMinats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $calonSiswaMinats = $this->calonSiswaMinatRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($calonSiswaMinats->toArray(), 'Calon Siswa Minats retrieved successfully');
    }

    /**
     * Store a newly created CalonSiswaMinat in storage.
     * POST /calonSiswaMinats
     *
     * @param CreateCalonSiswaMinatAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCalonSiswaMinatAPIRequest $request)
    {
        $input = $request->all();

        $calonSiswaMinat = $this->calonSiswaMinatRepository->create($input);

        return $this->sendResponse($calonSiswaMinat->toArray(), 'Calon Siswa Minat saved successfully');
    }

    /**
     * Display the specified CalonSiswaMinat.
     * GET|HEAD /calonSiswaMinats/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CalonSiswaMinat $calonSiswaMinat */
        $calonSiswaMinat = $this->calonSiswaMinatRepository->find($id);

        if (empty($calonSiswaMinat)) {
            return $this->sendError('Calon Siswa Minat not found');
        }

        return $this->sendResponse($calonSiswaMinat->toArray(), 'Calon Siswa Minat retrieved successfully');
    }

    /**
     * Update the specified CalonSiswaMinat in storage.
     * PUT/PATCH /calonSiswaMinats/{id}
     *
     * @param int $id
     * @param UpdateCalonSiswaMinatAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCalonSiswaMinatAPIRequest $request)
    {
        $input = $request->all();

        /** @var CalonSiswaMinat $calonSiswaMinat */
        $calonSiswaMinat = $this->calonSiswaMinatRepository->find($id);

        if (empty($calonSiswaMinat)) {
            return $this->sendError('Calon Siswa Minat not found');
        }

        $calonSiswaMinat = $this->calonSiswaMinatRepository->update($input, $id);

        return $this->sendResponse($calonSiswaMinat->toArray(), 'CalonSiswaMinat updated successfully');
    }

    /**
     * Remove the specified CalonSiswaMinat from storage.
     * DELETE /calonSiswaMinats/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CalonSiswaMinat $calonSiswaMinat */
        $calonSiswaMinat = $this->calonSiswaMinatRepository->find($id);

        if (empty($calonSiswaMinat)) {
            return $this->sendError('Calon Siswa Minat not found');
        }

        $calonSiswaMinat->delete();

        return $this->sendSuccess('Calon Siswa Minat deleted successfully');
    }
}
