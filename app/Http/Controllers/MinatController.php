<?php

namespace App\Http\Controllers;

use App\DataTables\MinatDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMinatRequest;
use App\Http\Requests\UpdateMinatRequest;
use App\Repositories\MinatRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MinatController extends AppBaseController
{
    /** @var  MinatRepository */
    private $minatRepository;

    public function __construct(MinatRepository $minatRepo)
    {
        $this->minatRepository = $minatRepo;
    }

    /**
     * Display a listing of the Minat.
     *
     * @param MinatDataTable $minatDataTable
     * @return Response
     */
    public function index(MinatDataTable $minatDataTable)
    {
        return $minatDataTable->render('minats.index');
    }

    /**
     * Show the form for creating a new Minat.
     *
     * @return Response
     */
    public function create()
    {
        return view('minats.create');
    }

    /**
     * Store a newly created Minat in storage.
     *
     * @param CreateMinatRequest $request
     *
     * @return Response
     */
    public function store(CreateMinatRequest $request)
    {
        $input = $request->all();

        $minat = $this->minatRepository->create($input);

        Flash::success('Minat saved successfully.');

        return redirect(route('minats.index'));
    }

    /**
     * Display the specified Minat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $minat = $this->minatRepository->find($id);

        if (empty($minat)) {
            Flash::error('Minat not found');

            return redirect(route('minats.index'));
        }

        return view('minats.show')->with('minat', $minat);
    }

    /**
     * Show the form for editing the specified Minat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $minat = $this->minatRepository->find($id);

        if (empty($minat)) {
            Flash::error('Minat not found');

            return redirect(route('minats.index'));
        }

        return view('minats.edit')->with('minat', $minat);
    }

    /**
     * Update the specified Minat in storage.
     *
     * @param  int              $id
     * @param UpdateMinatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMinatRequest $request)
    {
        $minat = $this->minatRepository->find($id);

        if (empty($minat)) {
            Flash::error('Minat not found');

            return redirect(route('minats.index'));
        }

        $minat = $this->minatRepository->update($request->all(), $id);

        Flash::success('Minat updated successfully.');

        return redirect(route('minats.index'));
    }

    /**
     * Remove the specified Minat from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $minat = $this->minatRepository->find($id);

        if (empty($minat)) {
            Flash::error('Minat not found');

            return redirect(route('minats.index'));
        }

        $this->minatRepository->delete($id);

        Flash::success('Minat deleted successfully.');

        return redirect(route('minats.index'));
    }
}
