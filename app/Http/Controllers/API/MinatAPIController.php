<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMinatAPIRequest;
use App\Http\Requests\API\UpdateMinatAPIRequest;
use App\Models\Minat;
use App\Repositories\MinatRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MinatController
 * @package App\Http\Controllers\API
 */

class MinatAPIController extends AppBaseController
{
    /** @var  MinatRepository */
    private $minatRepository;

    public function __construct(MinatRepository $minatRepo)
    {
        $this->minatRepository = $minatRepo;
    }

    /**
     * Display a listing of the Minat.
     * GET|HEAD /minats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $minats = $this->minatRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($minats->toArray(), 'Minats retrieved successfully');
    }

    /**
     * Store a newly created Minat in storage.
     * POST /minats
     *
     * @param CreateMinatAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMinatAPIRequest $request)
    {
        $input = $request->all();

        $minat = $this->minatRepository->create($input);

        return $this->sendResponse($minat->toArray(), 'Minat saved successfully');
    }

    /**
     * Display the specified Minat.
     * GET|HEAD /minats/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Minat $minat */
        $minat = $this->minatRepository->find($id);

        if (empty($minat)) {
            return $this->sendError('Minat not found');
        }

        return $this->sendResponse($minat->toArray(), 'Minat retrieved successfully');
    }

    /**
     * Update the specified Minat in storage.
     * PUT/PATCH /minats/{id}
     *
     * @param int $id
     * @param UpdateMinatAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMinatAPIRequest $request)
    {
        $input = $request->all();

        /** @var Minat $minat */
        $minat = $this->minatRepository->find($id);

        if (empty($minat)) {
            return $this->sendError('Minat not found');
        }

        $minat = $this->minatRepository->update($input, $id);

        return $this->sendResponse($minat->toArray(), 'Minat updated successfully');
    }

    /**
     * Remove the specified Minat from storage.
     * DELETE /minats/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Minat $minat */
        $minat = $this->minatRepository->find($id);

        if (empty($minat)) {
            return $this->sendError('Minat not found');
        }

        $minat->delete();

        return $this->sendSuccess('Minat deleted successfully');
    }
}
