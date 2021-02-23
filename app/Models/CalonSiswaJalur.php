<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Minat
 * @package App\Models
 * @version February 9, 2021, 7:47 am UTC
 *
 * @property string $minat
 */
class CalonSiswaJalur extends Model
{
    use SoftDeletes;


    public $table = 'calon_siswa_jalur';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'calon_siswa_id',
        'jalur_id',
        'jalur_partisipasi_id',
        'certificate'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'id' => 'integer',
        // 'minat' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}
