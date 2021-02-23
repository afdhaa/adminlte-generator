<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * Class CalonSiswa
 * @package App\Models
 * @version February 9, 2021, 7:44 am UTC
 *
 * @property string $nisn
 * @property string $nama_lengkap
 * @property string $tanggal_lahir
 * @property string $tempat_lahir
 * @property string $anak_ke
 * @property string $jml_saudara
 * @property string $hp_siswa
 * @property string $nik
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $provinsi
 * @property string $kota
 * @property string $kecamatan
 * @property string $desa
 * @property string $nama_ayah
 * @property string $pekerjaan_ayah
 * @property string $nama_ibu
 * @property string $pekerjaan_ibu
 * @property string $nama_wali
 * @property string $pekerjaan_wali
 * @property string $hp_wali
 * @property string $asal_smp
 * @property string $kota_smp
 * @property integer $mat_s1
 * @property integer $mat_s2
 * @property integer $mat_s3
 * @property integer $mat_s4
 * @property integer $mat_s5
 * @property integer $rt_mat
 * @property integer $inggris_s1
 * @property integer $inggris_s2
 * @property integer $inggris_s3
 * @property integer $inggris_s4
 * @property integer $inggris_s5
 * @property integer $rt_inggris
 * @property integer $indonesia_s1
 * @property integer $indonesia_s2
 * @property integer $indonesia_s3
 * @property integer $indonesia_s4
 * @property integer $indonesia_s5
 * @property integer $rt_indonesia
 * @property integer $ipa_s1
 * @property integer $ipa_s2
 * @property integer $ipa_s3
 * @property integer $ipa_s4
 * @property integer $ipa_s5
 * @property integer $rt_ipa
 * @property integer $ips_s1
 * @property integer $ips_s2
 * @property integer $ips_s3
 * @property integer $ips_s4
 * @property integer $ips_s5
 * @property integer $rt_ips
 * @property string $password
 * @property string $email
 */
class CalonSiswa extends Authenticatable
{
    use SoftDeletes, HasApiTokens;


    public $table = 'calon_siswas';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nisn',
        'nama_lengkap',
        'tanggal_lahir',
        'tempat_lahir',
        'anak_ke',
        'jenis_kelamin',
        'jml_saudara',
        'hp_siswa',
        'nik',
        'alamat',
        'rt',
        'rw',
        'provinsi',
        'kota',
        'kecamatan',
        'desa',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'hp_wali',
        'asal_smp',
        'kota_smp',
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
        'password',
        'email',
        'image_kk',
        'image_pas_photo',
        'image_raport'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nisn' => 'string',
        'nama_lengkap' => 'string',
        'tanggal_lahir' => 'date',
        'tempat_lahir' => 'string',
        'anak_ke' => 'string',
        'jml_saudara' => 'string',
        'hp_siswa' => 'string',
        'nik' => 'string',
        'alamat' => 'string',
        'rt' => 'string',
        'rw' => 'string',
        'provinsi' => 'string',
        'kota' => 'string',
        'kecamatan' => 'string',
        'desa' => 'string',
        'nama_ayah' => 'string',
        'pekerjaan_ayah' => 'string',
        'nama_ibu' => 'string',
        'pekerjaan_ibu' => 'string',
        'nama_wali' => 'string',
        'pekerjaan_wali' => 'string',
        'hp_wali' => 'string',
        'asal_smp' => 'string',
        'kota_smp' => 'string',
        'mat_s1' => 'integer',
        'mat_s2' => 'integer',
        'mat_s3' => 'integer',
        'mat_s4' => 'integer',
        'mat_s5' => 'integer',
        'rt_mat' => 'integer',
        'inggris_s1' => 'integer',
        'inggris_s2' => 'integer',
        'inggris_s3' => 'integer',
        'inggris_s4' => 'integer',
        'inggris_s5' => 'integer',
        'rt_inggris' => 'integer',
        'indonesia_s1' => 'integer',
        'indonesia_s2' => 'integer',
        'indonesia_s3' => 'integer',
        'indonesia_s4' => 'integer',
        'indonesia_s5' => 'integer',
        'rt_indonesia' => 'integer',
        'ipa_s1' => 'integer',
        'ipa_s2' => 'integer',
        'ipa_s3' => 'integer',
        'ipa_s4' => 'integer',
        'ipa_s5' => 'integer',
        'rt_ipa' => 'integer',
        'ips_s1' => 'integer',
        'ips_s2' => 'integer',
        'ips_s3' => 'integer',
        'ips_s4' => 'integer',
        'ips_s5' => 'integer',
        'rt_ips' => 'integer',
        'password' => 'string',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}
