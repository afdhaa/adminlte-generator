<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCalonSiswaAPIRequest;
use App\Http\Requests\API\UpdateCalonSiswaAPIRequest;
use App\Models\CalonSiswa;
use App\Repositories\CalonSiswaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\CalonSiswaJalur;
use App\Models\CalonSiswaMinat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

/**
 * Class CalonSiswaController
 * @package App\Http\Controllers\API
 */

class CalonSiswaAPIController extends AppBaseController
{
    /** @var  CalonSiswaRepository */
    private $calonSiswaRepository;

    public function __construct(CalonSiswaRepository $calonSiswaRepo)
    {
        $this->calonSiswaRepository = $calonSiswaRepo;
    }

    /**
     * Display a listing of the CalonSiswa.
     * GET|HEAD /calonSiswas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = CalonSiswa::where('id', Auth::guard('api')->user()->id)->first();
        $array = array($data);
        array_walk_recursive($data, function (&$item) {
            $item = strval($item);
        });
        $percentage_isi_data = $this->complete_percentage('Models\CalonSiswa', 'calon_siswas', Auth::guard('api')->user()->id);
        $percentage_jalur = $this->complete_percentage_jalur('Models\CalonSiswaJalur', 'calon_siswa_jalur', Auth::guard('api')->user()->id);
        $percentage_minat = $this->complete_percentage_jalur('Models\CalonSiswaMinat', 'calon_siswa_minats', Auth::guard('api')->user()->id);
        // print_r($percentage_isi_data);
        // die();
        return $this->sendSuccess([
            'percentage_isi_data' => $percentage_isi_data,
            'percentage_jalur' => $percentage_jalur,
            'percentage_minat' => $percentage_minat,
            'user_data' => $data
        ], 'User Info');
    }

    private function complete_percentage($model, $table_name, $resource)
    {
        $pos_info =  DB::select(DB::raw('SHOW COLUMNS FROM ' . $table_name));
        $base_columns = count($pos_info);
        $not_null = 0;
        foreach ($pos_info as $col) {
            if ($col->Field !=  'created_at' && $col->Field !=  'updated_at' && $col->Field !=  'deleted_at' && $col->Field !=  'id') {
                $not_null += app('App\\' . $model)::selectRaw('SUM(CASE WHEN ' . $col->Field . ' IS NOT NULL THEN 1 ELSE 0 END) AS not_null')->where('id', '=', $resource)->first()->not_null;
            }
        }

        return ($not_null / $base_columns) * 100;
    }

    private function complete_percentage_jalur($model, $table_name, $resource)
    {
        $pos_info =  DB::select(DB::raw('SHOW COLUMNS FROM ' . $table_name));
        $base_columns = count($pos_info);
        $not_null = 0;
        foreach ($pos_info as $col) {
            if ($col->Field != 'jalur_partisipasi_id' && $col->Field != 'id' && $col->Field !=  'created_at' && $col->Field !=  'updated_at' && $col->Field !=  'deleted_at' && $col->Field !=  'calon_siswa_id') {
                $not_null += app('App\\' . $model)::selectRaw('SUM(CASE WHEN ' . $col->Field . ' IS NOT NULL THEN 1 ELSE 0 END) AS not_null')->where('calon_siswa_id', '=', $resource)->first()->not_null;
            }
        }

        return ($not_null / $base_columns) * 100;
    }

    /**
     * Store a newly created CalonSiswa in storage.
     * POST /calonSiswas
     *
     * @param CreateCalonSiswaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCalonSiswaAPIRequest $request)
    {
        $input = $request->all();
        if ($request->type == 'register') {

            $check = CalonSiswa::where('email', $request->email)->count();
            // print_r($check);
            // die();
            if ($check > 0) {
                return $this->sendError('Email Sudah Terdaftar !');
                // return response()->json(compact('user', 'token'), 200);
            } else {
                $validator = Validator::make($request->all(), [
                    'fullname' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors()->toJson(), 400);
                }

                $user = CalonSiswa::create([
                    'nama_lengkap' => $request->fullname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $token = $user->createToken('MyApp')->accessToken;
                $send = [
                    'user' => $user,
                    'token' => $token
                ];
                return $this->sendSuccess($send, 'Sukses Registrasi !');
            }
        }

        if ($request->type == 'login') {
            if ($user = CalonSiswa::where('email', $request->email)->first()) {
                $check_pass = Hash::check($request->password, $user->password);
                if ($check_pass == 1) {
                    $success['token'] =  $user->createToken('MyApp')->accessToken;
                    $send = [
                        'user' => $user,
                        'token' => $success['token']
                    ];
                } else {
                    return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                }

                return $this->sendSuccess($send, 'User login successfully.');
            } else {

                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
            }
        }
    }

    public function isidata(Request $request)
    {
        $input = $request->all();

        if ($request->step == 'all') {
            $data = request()->except(['step', 'api']);

            // Remove empty array values from the data
            $result = array_filter($data);
            $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
                ->update($result);
            // $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
            //     ->update([
            //         'nama_lengkap' => $request->nama_lengkap,
            //         'nisn' => $request->nisn,
            //         'tanggal_lahir' => "$request->tanggal_lahir",
            //         'tempat_lahir' => $request->tempat_lahir,
            //         'jenis_kelamin' => $request->jenis_kelamin,
            //         'anak_ke' => $request->anak_ke,
            //         'jml_saudara' => $request->jml_saudara,
            //         'hp_siswa' => $request->hp_siswa,
            //         'nik' => $request->nik,
            //         'alamat' => $request->alamat,
            //         'rt' => $request->rt,
            //         'rw' => $request->rw,
            //         'provinsi' => $request->provinsi,
            //         'kecamatan' => $request->kecamatan,
            //         'desa' => $request->desa,
            //         'nama_ayah' => $request->nama_ayah,
            //         'pekerjaan_ayah' => $request->pekerjaan_ayah,
            //         'nama_ibu' => $request->nama_ibu,
            //         'pekerjaan_ibu' => $request->pekerjaan_ibu,
            //         'nama_wali' => $request->nama_wali,
            //         'pekerjaan_wali' => $request->pekerjaan_wali,
            //         'hp_wali' => $request->hp_wali,
            //         'asal_smp' => $request->asal_smp,
            //         'kota_smp' => $request->kota_smp,
            //         'mat_s1' => $request->mat_s1,
            //         'mat_s2' => $request->mat_s2,
            //         'mat_s3' => $request->mat_s3,
            //         'mat_s4' => $request->mat_s4,
            //         'mat_s5' => $request->mat_s5,
            //         'rt_mat' => $request->rt_mat,
            //         'inggris_s1' => $request->inggris_s1,
            //         'inggris_s2' => $request->inggris_s2,
            //         'inggris_s3' => $request->inggris_s3,
            //         'inggris_s4' => $request->inggris_s4,
            //         'inggris_s5' => $request->inggris_s5,
            //         'rt_inggris' => $request->rt_inggris,
            //         'indonesia_s1' => $request->indonesia_s1,
            //         'indonesia_s2' => $request->indonesia_s2,
            //         'indonesia_s3' => $request->indonesia_s3,
            //         'indonesia_s4' => $request->indonesia_s4,
            //         'indonesia_s5' => $request->indonesia_s5,
            //         'rt_indonesia' => $request->rt_indonesia,
            //         'ipa_s1' => $request->ipa_s1,
            //         'ipa_s2' => $request->ipa_s2,
            //         'ipa_s3' => $request->ipa_s3,
            //         'ipa_s4' => $request->ipa_s4,
            //         'ipa_s5' => $request->ipa_s5,
            //         'rt_ipa' => $request->rt_ipa,
            //         'ips_s1' => $request->ips_s1,
            //         'ips_s2' => $request->ips_s2,
            //         'ips_s3' => $request->ips_s3,
            //         'ips_s4' => $request->ips_s4,
            //         'ips_s5' => $request->ips_s5,
            //         'rt_ips' => $request->rt_ips,
            //     ]);
            return $this->sendSuccess([], 'User update successfully step all');
        }

        // if ($request->step == '1') {
        //     // print_r("cek");
        //     // print_r(Auth::guard('api')->user()->id);
        //     $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
        //         ->update([
        //             'nama_lengkap' => $request->nama_lengkap,
        //             'nisn' => $request->nisn,
        //             'tanggal_lahir' => "$request->tanggal_lahir",
        //             'tempat_lahir' => $request->tempat_lahir,
        //             'jenis_kelamin' => $request->jenis_kelamin,
        //             'anak_ke' => $request->anak_ke,
        //             'jml_saudara' => $request->jml_saudara,
        //             'hp_siswa' => $request->hp_siswa,
        //             'nik' => $request->nik,
        //         ]);
        //     return $this->sendSuccess([], 'User update successfully step 1');
        // }
        // if ($request->step == '2') {
        //     // print_r("cek");
        //     // print_r(Auth::guard('api')->user()->id);
        //     $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
        //         ->update([
        //             'alamat' => $request->alamat,
        //             'rt' => $request->rt,
        //             'rw' => $request->rw,
        //             'provinsi' => $request->provinsi,
        //             'kecamatan' => $request->kecamatan,
        //             'desa' => $request->desa,
        //         ]);
        //     return $this->sendSuccess([], 'User update successfully step 2');
        // }

        // if ($request->step == '3') {
        //     // print_r("cek");
        //     // print_r(Auth::guard('api')->user()->id);
        //     $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
        //         ->update([
        //             'nama_ayah' => $request->nama_ayah,
        //             'pekerjaan_ayah' => $request->pekerjaan_ayah,
        //             'nama_ibu' => $request->nama_ibu,
        //             'pekerjaan_ibu' => $request->pekerjaan_ibu,
        //             'nama_wali' => $request->nama_wali,
        //             'pekerjaan_wali' => $request->pekerjaan_wali,
        //             'hp_wali' => $request->hp_wali,
        //         ]);
        //     return $this->sendSuccess([], 'User update successfully step 3');
        // }

        // if ($request->step == '4') {
        //     // print_r("cek");
        //     // print_r(Auth::guard('api')->user()->id);
        //     $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
        //         ->update([
        //             'asal_smp' => $request->asal_smp,
        //             'kota_smp' => $request->kota_smp,
        //         ]);
        //     return $this->sendSuccess([], 'User update successfully step 4');
        // }

        // if ($request->step == '5') {
        //     // print_r("cek");
        //     // print_r(Auth::guard('api')->user()->id);
        //     $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
        //         ->update([
        //             'mat_s1' => $request->mat_s1,
        //             'mat_s2' => $request->mat_s2,
        //             'mat_s3' => $request->mat_s3,
        //             'mat_s4' => $request->mat_s4,
        //             'mat_s5' => $request->mat_s5,
        //             'rt_mat' => $request->rt_mat,
        //             'inggris_s1' => $request->inggris_s1,
        //             'inggris_s2' => $request->inggris_s2,
        //             'inggris_s3' => $request->inggris_s3,
        //             'inggris_s4' => $request->inggris_s4,
        //             'inggris_s5' => $request->inggris_s5,
        //             'rt_inggris' => $request->rt_inggris,
        //             'indonesia_s1' => $request->indonesia_s1,
        //             'indonesia_s2' => $request->indonesia_s2,
        //             'indonesia_s3' => $request->indonesia_s3,
        //             'indonesia_s4' => $request->indonesia_s4,
        //             'indonesia_s5' => $request->indonesia_s5,
        //             'rt_indonesia' => $request->rt_indonesia,
        //             'ipa_s1' => $request->ipa_s1,
        //             'ipa_s2' => $request->ipa_s2,
        //             'ipa_s3' => $request->ipa_s3,
        //             'ipa_s4' => $request->ipa_s4,
        //             'ipa_s5' => $request->ipa_s5,
        //             'rt_ipa' => $request->rt_ipa,
        //             'ips_s1' => $request->ips_s1,
        //             'ips_s2' => $request->ips_s2,
        //             'ips_s3' => $request->ips_s3,
        //             'ips_s4' => $request->ips_s4,
        //             'ips_s5' => $request->ips_s5,
        //             'rt_ips' => $request->rt_ips,
        //         ]);
        //     return $this->sendSuccess([], 'User update successfully step 5');
        // }
        if ($request->step == 'scan') {
            // print_r("cek");
            // print_r(Auth::guard('api')->user()->id);
            // echo url('');
            // die();
            if (isset($input['image_kk']) && isset($input['image_pas_photo']) && isset($input['image_raport'])) {

                $folderPath = public_path('/kk/');
                $image_parts = explode(";base64,", $request->image_kk);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $filename = "KK" . uniqid() . '.' . $image_type;
                $file = $folderPath . $filename;
                file_put_contents($file, $image_base64);

                // $file = $input['image_kk'];
                // $filename = 'KK-' . time() . '.' . $file->getClientOriginalExtension();
                // $file->move('kk', $filename);
                $input['image_kk'] = url('kk/') . "/" . $filename;

                // $file2 = $input['image_pas_photo'];
                // $filename2 = 'PasPhoto-' . time() . '.' . $file2->getClientOriginalExtension();
                // $file2->move('pasphoto', $filename2);

                $folderPath2 = public_path('/pasphoto/');
                $image_parts2 = explode(";base64,", $request->image_pas_photo);
                $image_type_aux2 = explode("image/", $image_parts2[0]);
                $image_type2 = $image_type_aux2[1];
                $image_base642 = base64_decode($image_parts2[1]);
                $filename2 = "KK" . uniqid() . '.' . $image_type2;
                $file2 = $folderPath2 . $filename2;
                file_put_contents($file2, $image_base642);
                $input['image_pas_photo'] = url('pasphoto/') . "/" . $filename2;

                $folderPath3 = public_path('/raport/');
                $image_parts3 = explode(";base64,", $request->image_pas_photo);
                $image_type_aux3 = explode("image/", $image_parts3[0]);
                $image_type3 = $image_type_aux3[1];
                $image_base643 = base64_decode($image_parts3[1]);
                $filename3 = "KK" . uniqid() . '.' . $image_type3;
                $file3 = $folderPath3 . $filename3;
                file_put_contents($file3, $image_base643);
                $input['image_raport'] = url('raport/') . "/" . $filename3;
                // $file3 = $input['image_raport'];
                // $filename3 = 'raport-' . time() . '.' . $file3->getClientOriginalExtension();
                // $file3->move('raport', $filename3);
                // $input['image_raport'] = url('raport/') . "/" . $filename3;

                // $product = $this->bannerRepository->create($input);

                $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
                    ->update([
                        'image_kk' => $input['image_kk'],
                        'image_pas_photo' => $input['image_pas_photo'],
                        'image_raport' => $input['image_raport'],
                    ]);
                return $this->sendSuccess([], 'User update successfully step scan');
            } else if (isset($input['image_kk'])) {
                $file = $input['image_kk'];
                $filename = 'KK-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move('kk', $filename);
                $input['image_kk'] = url('kk/') . "/" . $filename;

                // $product = $this->bannerRepository->create($input);

                $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
                    ->update([
                        'image_kk' => $input['image_kk'],
                    ]);
                return $this->sendSuccess([], 'User update successfully step scan kk');
            } else if (isset($input['image_pas_photo'])) {
                $file2 = $input['image_pas_photo'];
                $filename2 = 'PasPhoto-' . time() . '.' . $file2->getClientOriginalExtension();
                $file2->move('pasphoto', $filename2);
                $input['image_pas_photo'] = url('pasphoto/') . "/" . $filename2;


                $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
                    ->update([
                        'image_pas_photo' => $input['image_pas_photo'],
                    ]);
                return $this->sendSuccess([], 'User update successfully step scan pas photo');
            } else if (isset($input['image_raport'])) {

                $file3 = $input['image_raport'];
                $filename3 = 'raport-' . time() . '.' . $file3->getClientOriginalExtension();
                $file3->move('raport', $filename3);
                $input['image_raport'] = url('raport/') . "/" . $filename3;

                // $product = $this->bannerRepository->create($input);

                $update = CalonSiswa::where('id', Auth::guard('api')->user()->id)
                    ->update([
                        'image_raport' => $input['image_raport'],
                    ]);
                return $this->sendSuccess([], 'User update successfully step scan raport');
            } else {
                return $this->sendError("Failed", 'Failed');
            }
        }
    }

    public function cekisidata(Request $request)
    {
        if ($request->step == '1') {
            // print_r("cek");
            // print_r(Auth::guard('api')->user()->id);
            $data = CalonSiswa::select(
                'id',
                'nama_lengkap',
                'nisn',
                'tanggal_lahir',
                'tempat_lahir',
                'jenis_kelamin',
                'anak_ke',
                'jml_saudara',
                'hp_siswa',
                'nik'
            )->where('id', Auth::guard('api')->user()->id)->first();
            $array = array($data);
            array_walk_recursive($data, function (&$item) {
                $item = strval($item);
            });
            return $this->sendSuccess($data->toArray(), 'User data step 1');
        }
        if ($request->step == '2') {
            // print_r("cek");
            // print_r(Auth::guard('api')->user()->id);
            $data = CalonSiswa::select(
                'alamat',
                'rt',
                'rw',
                'provinsi',
                'kecamatan',
                'desa',
            )->where('id', Auth::guard('api')->user()->id)->first();
            $array = array($data);
            array_walk_recursive($data, function (&$item) {
                $item = strval($item);
            });
            return $this->sendSuccess($data->toArray(), 'User data step 2');
        }
        if ($request->step == '3') {
            // print_r("cek");
            // print_r(Auth::guard('api')->user()->id);
            $data = CalonSiswa::select(
                'nama_ayah',
                'pekerjaan_ayah',
                'nama_ibu',
                'pekerjaan_ibu',
                'nama_wali',
                'pekerjaan_wali',
                'hp_wali',
            )->where('id', Auth::guard('api')->user()->id)->first();
            $array = array($data);
            array_walk_recursive($data, function (&$item) {
                $item = strval($item);
            });
            return $this->sendSuccess($data->toArray(), 'User data step 3');
        }

        if ($request->step == '4') {
            // print_r("cek");
            // print_r(Auth::guard('api')->user()->id);
            $data = CalonSiswa::select(
                'asal_smp',
                'kota_smp',
            )->where('id', Auth::guard('api')->user()->id)->first();
            $array = array($data);
            array_walk_recursive($data, function (&$item) {
                $item = strval($item);
            });
            return $this->sendSuccess($data->toArray(), 'User data step 4');
        }

        if ($request->step == '5') {
            // print_r("cek");
            // print_r(Auth::guard('api')->user()->id);
            $data = CalonSiswa::select(
                'mat_s1',
                'mat_s2',
                'mat_s3',
                'mat_s4',
                'mat_s5',
                'rt_mat',
                'inggris_s1',
                'inggris_s2',
                'inggris_s3',
                'inggris_s4',
                'inggris_s5',
                'rt_inggris',
                'indonesia_s1',
                'indonesia_s2',
                'indonesia_s3',
                'indonesia_s4',
                'indonesia_s5',
                'rt_indonesia',
                'ipa_s1',
                'ipa_s2',
                'ipa_s3',
                'ipa_s4',
                'ipa_s5',
                'rt_ipa',
                'ips_s1',
                'ips_s2',
                'ips_s3',
                'ips_s4',
                'ips_s5',
                'rt_ips',
            )->where('id', Auth::guard('api')->user()->id)->first();
            $array = array($data);
            array_walk_recursive($data, function (&$item) {
                $item = strval($item);
            });
            return $this->sendSuccess($data->toArray(), 'User data step 5');
        }

        if ($request->step == '6') {
            // print_r("cek");
            // print_r(Auth::guard('api')->user()->id);
            $data = CalonSiswa::select(
                'image_kk',
                'image_pas_photo',
                'image_raport',
            )->where('id', Auth::guard('api')->user()->id)->first();
            $array = array($data);
            array_walk_recursive($data, function (&$item) {
                $item = strval($item);
            });
            return $this->sendSuccess($data->toArray(), 'User data step 6');
        }
    }

    public function pilihJalur(Request $request)
    {
        if ($request->certificate) {
            $folderPath = public_path('/certificate/');
            $image_parts = explode(";base64,", $request->certificate);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = "certificate" . uniqid() . '.' . $image_type;
            $file = $folderPath . $filename;
            file_put_contents($file, $image_base64);
            $update = CalonSiswaJalur::where('calon_siswa_id', Auth::guard('api')->user()->id)
                ->update([
                    'jalur_id' => $request->jalur_id,
                    'jalur_partisipasi_id' => $request->jalur_partisipasi_id,
                    'certificate' => url('certificate/') . "/" . $filename
                ]);
            return $this->sendSuccess([], 'User update Jalur successfully ');
        } else {
            $update = CalonSiswaJalur::where('calon_siswa_id', Auth::guard('api')->user()->id)
                ->update([
                    'jalur_id' => $request->jalur_id,
                    'jalur_partisipasi_id' => $request->jalur_partisipasi_id,
                ]);
            return $this->sendSuccess([], 'User update Jalur successfully ');
        }
    }

    public function cekpilihJalur(Request $request)
    {
        $data = CalonSiswaJalur::select('calon_siswa_id', 'jalur', 'participate', 'certificate', 'jalurs.id as jalur_id')
            ->where('calon_siswa_id', Auth::guard('api')->user()->id)
            ->join('jalurs', 'jalurs.id', 'calon_siswa_jalur.jalur_id')
            ->leftJoin('jalur_partisipasis', 'jalur_partisipasis.id', 'calon_siswa_jalur.jalur_partisipasi_id')
            ->first();
        $array = array($data);
        array_walk_recursive($data, function (&$item) {
            $item = strval($item);
        });
        return $this->sendSuccess($data, 'Success Get Cek Jalur ');
    }

    public function pilihMinat(Request $request)
    {
        $update = CalonSiswaMinat::where('calon_siswa_id', Auth::guard('api')->user()->id)
            ->update([
                'minat_id' => $request->minat_id,
            ]);
        return $this->sendSuccess([], 'User update Minat successfully ');
    }

    public function cekpilihMinat(Request $request)
    {
        $data = CalonSiswaMinat::select('calon_siswa_id', 'minat', 'minats.id as minat_id')
            ->where('calon_siswa_id', Auth::guard('api')->user()->id)
            ->join('minats', 'minats.id', 'calon_siswa_minats.minat_id')
            ->first();
        $array = array($data);
        array_walk_recursive($data, function (&$item) {
            $item = strval($item);
        });
        return $this->sendSuccess($data, 'Success Get Cek Jalur ');
    }

    /**
     * Display the specified CalonSiswa.
     * GET|HEAD /calonSiswas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CalonSiswa $calonSiswa */
        $calonSiswa = $this->calonSiswaRepository->find($id);

        if (empty($calonSiswa)) {
            return $this->sendError('Calon Siswa not found');
        }

        return $this->sendResponse($calonSiswa->toArray(), 'Calon Siswa retrieved successfully');
    }

    /**
     * Update the specified CalonSiswa in storage.
     * PUT/PATCH /calonSiswas/{id}
     *
     * @param int $id
     * @param UpdateCalonSiswaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCalonSiswaAPIRequest $request)
    {
        $input = $request->all();

        /** @var CalonSiswa $calonSiswa */
        $calonSiswa = $this->calonSiswaRepository->find($id);

        if (empty($calonSiswa)) {
            return $this->sendError('Calon Siswa not found');
        }

        $calonSiswa = $this->calonSiswaRepository->update($input, $id);

        return $this->sendResponse($calonSiswa->toArray(), 'CalonSiswa updated successfully');
    }

    /**
     * Remove the specified CalonSiswa from storage.
     * DELETE /calonSiswas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CalonSiswa $calonSiswa */
        $calonSiswa = $this->calonSiswaRepository->find($id);

        if (empty($calonSiswa)) {
            return $this->sendError('Calon Siswa not found');
        }

        $calonSiswa->delete();

        return $this->sendSuccess('Calon Siswa deleted successfully');
    }
}
