<?php

namespace App\Http\Controllers;

use App\DataTables\JalurDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateJalurRequest;
use App\Http\Requests\UpdateJalurRequest;
use App\Repositories\JalurRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class JalurController extends AppBaseController
{
    /** @var  JalurRepository */
    private $jalurRepository;

    public function __construct(JalurRepository $jalurRepo)
    {
        $this->jalurRepository = $jalurRepo;
    }

    /**
     * Display a listing of the Jalur.
     *
     * @param JalurDataTable $jalurDataTable
     * @return Response
     */
    public function index(JalurDataTable $jalurDataTable)
    {
        return $jalurDataTable->render('jalurs.index');
    }

    /**
     * Show the form for creating a new Jalur.
     *
     * @return Response
     */
    public function create()
    {
        return view('jalurs.create');
    }

    /**
     * Store a newly created Jalur in storage.
     *
     * @param CreateJalurRequest $request
     *
     * @return Response
     */
    public function store(CreateJalurRequest $request)
    {
        $input = $request->all();

        $jalur = $this->jalurRepository->create($input);

        Flash::success('Jalur saved successfully.');

        return redirect(route('jalurs.index'));
    }

    /**
     * Display the specified Jalur.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jalur = $this->jalurRepository->find($id);

        if (empty($jalur)) {
            Flash::error('Jalur not found');

            return redirect(route('jalurs.index'));
        }

        return view('jalurs.show')->with('jalur', $jalur);
    }

    /**
     * Show the form for editing the specified Jalur.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jalur = $this->jalurRepository->find($id);

        if (empty($jalur)) {
            Flash::error('Jalur not found');

            return redirect(route('jalurs.index'));
        }

        return view('jalurs.edit')->with('jalur', $jalur);
    }

    /**
     * Update the specified Jalur in storage.
     *
     * @param  int              $id
     * @param UpdateJalurRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJalurRequest $request)
    {
        $jalur = $this->jalurRepository->find($id);

        if (empty($jalur)) {
            Flash::error('Jalur not found');

            return redirect(route('jalurs.index'));
        }

        $jalur = $this->jalurRepository->update($request->all(), $id);

        Flash::success('Jalur updated successfully.');

        return redirect(route('jalurs.index'));
    }

    /**
     * Remove the specified Jalur from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jalur = $this->jalurRepository->find($id);

        if (empty($jalur)) {
            Flash::error('Jalur not found');

            return redirect(route('jalurs.index'));
        }

        $this->jalurRepository->delete($id);

        Flash::success('Jalur deleted successfully.');

        return redirect(route('jalurs.index'));
    }
}
