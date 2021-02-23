<?php

namespace App\Http\Controllers;

use App\DataTables\CalonSiswaMinatDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCalonSiswaMinatRequest;
use App\Http\Requests\UpdateCalonSiswaMinatRequest;
use App\Repositories\CalonSiswaMinatRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CalonSiswaMinatController extends AppBaseController
{
    /** @var  CalonSiswaMinatRepository */
    private $calonSiswaMinatRepository;

    public function __construct(CalonSiswaMinatRepository $calonSiswaMinatRepo)
    {
        $this->calonSiswaMinatRepository = $calonSiswaMinatRepo;
    }

    /**
     * Display a listing of the CalonSiswaMinat.
     *
     * @param CalonSiswaMinatDataTable $calonSiswaMinatDataTable
     * @return Response
     */
    public function index(CalonSiswaMinatDataTable $calonSiswaMinatDataTable)
    {
        return $calonSiswaMinatDataTable->render('calon_siswa_minats.index');
    }

    /**
     * Show the form for creating a new CalonSiswaMinat.
     *
     * @return Response
     */
    public function create()
    {
        return view('calon_siswa_minats.create');
    }

    /**
     * Store a newly created CalonSiswaMinat in storage.
     *
     * @param CreateCalonSiswaMinatRequest $request
     *
     * @return Response
     */
    public function store(CreateCalonSiswaMinatRequest $request)
    {
        $input = $request->all();

        $calonSiswaMinat = $this->calonSiswaMinatRepository->create($input);

        Flash::success('Calon Siswa Minat saved successfully.');

        return redirect(route('calonSiswaMinats.index'));
    }

    /**
     * Display the specified CalonSiswaMinat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $calonSiswaMinat = $this->calonSiswaMinatRepository->find($id);

        if (empty($calonSiswaMinat)) {
            Flash::error('Calon Siswa Minat not found');

            return redirect(route('calonSiswaMinats.index'));
        }

        return view('calon_siswa_minats.show')->with('calonSiswaMinat', $calonSiswaMinat);
    }

    /**
     * Show the form for editing the specified CalonSiswaMinat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $calonSiswaMinat = $this->calonSiswaMinatRepository->find($id);

        if (empty($calonSiswaMinat)) {
            Flash::error('Calon Siswa Minat not found');

            return redirect(route('calonSiswaMinats.index'));
        }

        return view('calon_siswa_minats.edit')->with('calonSiswaMinat', $calonSiswaMinat);
    }

    /**
     * Update the specified CalonSiswaMinat in storage.
     *
     * @param  int              $id
     * @param UpdateCalonSiswaMinatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCalonSiswaMinatRequest $request)
    {
        $calonSiswaMinat = $this->calonSiswaMinatRepository->find($id);

        if (empty($calonSiswaMinat)) {
            Flash::error('Calon Siswa Minat not found');

            return redirect(route('calonSiswaMinats.index'));
        }

        $calonSiswaMinat = $this->calonSiswaMinatRepository->update($request->all(), $id);

        Flash::success('Calon Siswa Minat updated successfully.');

        return redirect(route('calonSiswaMinats.index'));
    }

    /**
     * Remove the specified CalonSiswaMinat from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $calonSiswaMinat = $this->calonSiswaMinatRepository->find($id);

        if (empty($calonSiswaMinat)) {
            Flash::error('Calon Siswa Minat not found');

            return redirect(route('calonSiswaMinats.index'));
        }

        $this->calonSiswaMinatRepository->delete($id);

        Flash::success('Calon Siswa Minat deleted successfully.');

        return redirect(route('calonSiswaMinats.index'));
    }
}
