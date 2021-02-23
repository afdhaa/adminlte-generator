<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CalonSiswaMinat
 * @package App\Models
 * @version February 23, 2021, 8:16 am UTC
 *
 * @property integer $calon_siswa_id
 * @property integer $minat_id
 */
class CalonSiswaMinat extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'calon_siswa_minats';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'calon_siswa_id',
        'minat_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'calon_siswa_id' => 'integer',
        'minat_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
