<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSoalTestAPIRequest;
use App\Http\Requests\API\UpdateSoalTestAPIRequest;
use App\Models\SoalTest;
use App\Repositories\SoalTestRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SoalTestController
 * @package App\Http\Controllers\API
 */

class SoalTestAPIController extends AppBaseController
{
    /** @var  SoalTestRepository */
    private $soalTestRepository;

    public function __construct(SoalTestRepository $soalTestRepo)
    {
        $this->soalTestRepository = $soalTestRepo;
    }

    /**
     * Display a listing of the SoalTest.
     * GET|HEAD /soalTests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $soalTests = $this->soalTestRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($soalTests->toArray(), 'Soal Tests retrieved successfully');
    }

    /**
     * Store a newly created SoalTest in storage.
     * POST /soalTests
     *
     * @param CreateSoalTestAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSoalTestAPIRequest $request)
    {
        $input = $request->all();

        $soalTest = $this->soalTestRepository->create($input);

        return $this->sendResponse($soalTest->toArray(), 'Soal Test saved successfully');
    }

    /**
     * Display the specified SoalTest.
     * GET|HEAD /soalTests/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SoalTest $soalTest */
        $soalTest = $this->soalTestRepository->find($id);

        if (empty($soalTest)) {
            return $this->sendError('Soal Test not found');
        }

        return $this->sendResponse($soalTest->toArray(), 'Soal Test retrieved successfully');
    }

    /**
     * Update the specified SoalTest in storage.
     * PUT/PATCH /soalTests/{id}
     *
     * @param int $id
     * @param UpdateSoalTestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoalTestAPIRequest $request)
    {
        $input = $request->all();

        /** @var SoalTest $soalTest */
        $soalTest = $this->soalTestRepository->find($id);

        if (empty($soalTest)) {
            return $this->sendError('Soal Test not found');
        }

        $soalTest = $this->soalTestRepository->update($input, $id);

        return $this->sendResponse($soalTest->toArray(), 'SoalTest updated successfully');
    }

    /**
     * Remove the specified SoalTest from storage.
     * DELETE /soalTests/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SoalTest $soalTest */
        $soalTest = $this->soalTestRepository->find($id);

        if (empty($soalTest)) {
            return $this->sendError('Soal Test not found');
        }

        $soalTest->delete();

        return $this->sendSuccess('Soal Test deleted successfully');
    }
}
