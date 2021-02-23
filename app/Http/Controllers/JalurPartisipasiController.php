<?php

namespace App\Http\Controllers;

use App\DataTables\JalurPartisipasiDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateJalurPartisipasiRequest;
use App\Http\Requests\UpdateJalurPartisipasiRequest;
use App\Repositories\JalurPartisipasiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class JalurPartisipasiController extends AppBaseController
{
    /** @var  JalurPartisipasiRepository */
    private $jalurPartisipasiRepository;

    public function __construct(JalurPartisipasiRepository $jalurPartisipasiRepo)
    {
        $this->jalurPartisipasiRepository = $jalurPartisipasiRepo;
    }

    /**
     * Display a listing of the JalurPartisipasi.
     *
     * @param JalurPartisipasiDataTable $jalurPartisipasiDataTable
     * @return Response
     */
    public function index(JalurPartisipasiDataTable $jalurPartisipasiDataTable)
    {
        return $jalurPartisipasiDataTable->render('jalur_partisipasis.index');
    }

    /**
     * Show the form for creating a new JalurPartisipasi.
     *
     * @return Response
     */
    public function create()
    {
        return view('jalur_partisipasis.create');
    }

    /**
     * Store a newly created JalurPartisipasi in storage.
     *
     * @param CreateJalurPartisipasiRequest $request
     *
     * @return Response
     */
    public function store(CreateJalurPartisipasiRequest $request)
    {
        $input = $request->all();

        $jalurPartisipasi = $this->jalurPartisipasiRepository->create($input);

        Flash::success('Jalur Partisipasi saved successfully.');

        return redirect(route('jalurPartisipasis.index'));
    }

    /**
     * Display the specified JalurPartisipasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jalurPartisipasi = $this->jalurPartisipasiRepository->find($id);

        if (empty($jalurPartisipasi)) {
            Flash::error('Jalur Partisipasi not found');

            return redirect(route('jalurPartisipasis.index'));
        }

        return view('jalur_partisipasis.show')->with('jalurPartisipasi', $jalurPartisipasi);
    }

    /**
     * Show the form for editing the specified JalurPartisipasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jalurPartisipasi = $this->jalurPartisipasiRepository->find($id);

        if (empty($jalurPartisipasi)) {
            Flash::error('Jalur Partisipasi not found');

            return redirect(route('jalurPartisipasis.index'));
        }

        return view('jalur_partisipasis.edit')->with('jalurPartisipasi', $jalurPartisipasi);
    }

    /**
     * Update the specified JalurPartisipasi in storage.
     *
     * @param  int              $id
     * @param UpdateJalurPartisipasiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJalurPartisipasiRequest $request)
    {
        $jalurPartisipasi = $this->jalurPartisipasiRepository->find($id);

        if (empty($jalurPartisipasi)) {
            Flash::error('Jalur Partisipasi not found');

            return redirect(route('jalurPartisipasis.index'));
        }

        $jalurPartisipasi = $this->jalurPartisipasiRepository->update($request->all(), $id);

        Flash::success('Jalur Partisipasi updated successfully.');

        return redirect(route('jalurPartisipasis.index'));
    }

    /**
     * Remove the specified JalurPartisipasi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jalurPartisipasi = $this->jalurPartisipasiRepository->find($id);

        if (empty($jalurPartisipasi)) {
            Flash::error('Jalur Partisipasi not found');

            return redirect(route('jalurPartisipasis.index'));
        }

        $this->jalurPartisipasiRepository->delete($id);

        Flash::success('Jalur Partisipasi deleted successfully.');

        return redirect(route('jalurPartisipasis.index'));
    }
}
