<?php

namespace App\Http\Controllers;

use App\DataTables\CalonSiswaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCalonSiswaRequest;
use App\Http\Requests\UpdateCalonSiswaRequest;
use App\Repositories\CalonSiswaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CalonSiswaController extends AppBaseController
{
    /** @var  CalonSiswaRepository */
    private $calonSiswaRepository;

    public function __construct(CalonSiswaRepository $calonSiswaRepo)
    {
        $this->calonSiswaRepository = $calonSiswaRepo;
    }

    /**
     * Display a listing of the CalonSiswa.
     *
     * @param CalonSiswaDataTable $calonSiswaDataTable
     * @return Response
     */
    public function index(CalonSiswaDataTable $calonSiswaDataTable)
    {
        return $calonSiswaDataTable->render('calon_siswas.index');
    }

    /**
     * Show the form for creating a new CalonSiswa.
     *
     * @return Response
     */
    public function create()
    {
        return view('calon_siswas.create');
    }

    /**
     * Store a newly created CalonSiswa in storage.
     *
     * @param CreateCalonSiswaRequest $request
     *
     * @return Response
     */

    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'fullname' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors()->toJson(), 400);
    //     }

    //     $user = CalonSiswa::create([
    //         'name' => $request->get('fullname'),
    //         'email' => $request->get('email'),
    //         'password' => Hash::make($request->get('password')),
    //     ]);

    //     $token = JWTAuth::fromUser($user);

    //     return response()->json(compact('user', 'token'), 201);
    // }

    public function store(Request $request)
    {
        $input = $request->all();
        $calonSiswa = $this->calonSiswaRepository->create($input);

        Flash::success('Calon Siswa saved successfully.');

        return redirect(route('calonSiswas.index'));
        // if ($request->type == 'register') {
        //     # code...
        //     $validator = Validator::make($request->all(), [
        //         'fullname' => 'required|string|max:255',
        //         'email' => 'required|string|email|max:255|unique:users',
        //         'password' => 'required|string|min:6|confirmed',
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json($validator->errors()->toJson(), 400);
        //     }

        //     $user = CalonSiswa::create([
        //         'nama_lengkap' => $request->fullname,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //     ]);

        //     $token = JWTAuth::fromUser($user);

        //     return response()->json(compact('user', 'token'), 200);
        // } else {
        //     $calonSiswa = $this->calonSiswaRepository->create($input);

        //     Flash::success('Calon Siswa saved successfully.');

        //     return redirect(route('calonSiswas.index'));
        // }
    }

    /**
     * Display the specified CalonSiswa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $calonSiswa = $this->calonSiswaRepository->find($id);

        if (empty($calonSiswa)) {
            Flash::error('Calon Siswa not found');

            return redirect(route('calonSiswas.index'));
        }

        return view('calon_siswas.show')->with('calonSiswa', $calonSiswa);
    }

    /**
     * Show the form for editing the specified CalonSiswa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $calonSiswa = $this->calonSiswaRepository->find($id);

        if (empty($calonSiswa)) {
            Flash::error('Calon Siswa not found');

            return redirect(route('calonSiswas.index'));
        }

        return view('calon_siswas.edit')->with('calonSiswa', $calonSiswa);
    }

    /**
     * Update the specified CalonSiswa in storage.
     *
     * @param  int              $id
     * @param UpdateCalonSiswaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCalonSiswaRequest $request)
    {
        $calonSiswa = $this->calonSiswaRepository->find($id);

        if (empty($calonSiswa)) {
            Flash::error('Calon Siswa not found');

            return redirect(route('calonSiswas.index'));
        }

        $calonSiswa = $this->calonSiswaRepository->update($request->all(), $id);

        Flash::success('Calon Siswa updated successfully.');

        return redirect(route('calonSiswas.index'));
    }

    /**
     * Remove the specified CalonSiswa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $calonSiswa = $this->calonSiswaRepository->find($id);

        if (empty($calonSiswa)) {
            Flash::error('Calon Siswa not found');

            return redirect(route('calonSiswas.index'));
        }

        $this->calonSiswaRepository->delete($id);

        Flash::success('Calon Siswa deleted successfully.');

        return redirect(route('calonSiswas.index'));
    }
}
