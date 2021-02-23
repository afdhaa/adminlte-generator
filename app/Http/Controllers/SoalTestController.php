<?php

namespace App\Http\Controllers;

use App\DataTables\SoalTestDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSoalTestRequest;
use App\Http\Requests\UpdateSoalTestRequest;
use App\Repositories\SoalTestRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SoalTestController extends AppBaseController
{
    /** @var  SoalTestRepository */
    private $soalTestRepository;

    public function __construct(SoalTestRepository $soalTestRepo)
    {
        $this->soalTestRepository = $soalTestRepo;
    }

    /**
     * Display a listing of the SoalTest.
     *
     * @param SoalTestDataTable $soalTestDataTable
     * @return Response
     */
    public function index(SoalTestDataTable $soalTestDataTable)
    {
        return $soalTestDataTable->render('soal_tests.index');
    }

    /**
     * Show the form for creating a new SoalTest.
     *
     * @return Response
     */
    public function create()
    {
        return view('soal_tests.create');
    }

    /**
     * Store a newly created SoalTest in storage.
     *
     * @param CreateSoalTestRequest $request
     *
     * @return Response
     */
    public function store(CreateSoalTestRequest $request)
    {
        $input = $request->all();

        $soalTest = $this->soalTestRepository->create($input);

        Flash::success('Soal Test saved successfully.');

        return redirect(route('soalTests.index'));
    }

    /**
     * Display the specified SoalTest.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $soalTest = $this->soalTestRepository->find($id);

        if (empty($soalTest)) {
            Flash::error('Soal Test not found');

            return redirect(route('soalTests.index'));
        }

        return view('soal_tests.show')->with('soalTest', $soalTest);
    }

    /**
     * Show the form for editing the specified SoalTest.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $soalTest = $this->soalTestRepository->find($id);

        if (empty($soalTest)) {
            Flash::error('Soal Test not found');

            return redirect(route('soalTests.index'));
        }

        return view('soal_tests.edit')->with('soalTest', $soalTest);
    }

    /**
     * Update the specified SoalTest in storage.
     *
     * @param  int              $id
     * @param UpdateSoalTestRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoalTestRequest $request)
    {
        $soalTest = $this->soalTestRepository->find($id);

        if (empty($soalTest)) {
            Flash::error('Soal Test not found');

            return redirect(route('soalTests.index'));
        }

        $soalTest = $this->soalTestRepository->update($request->all(), $id);

        Flash::success('Soal Test updated successfully.');

        return redirect(route('soalTests.index'));
    }

    /**
     * Remove the specified SoalTest from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $soalTest = $this->soalTestRepository->find($id);

        if (empty($soalTest)) {
            Flash::error('Soal Test not found');

            return redirect(route('soalTests.index'));
        }

        $this->soalTestRepository->delete($id);

        Flash::success('Soal Test deleted successfully.');

        return redirect(route('soalTests.index'));
    }
}
