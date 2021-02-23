<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class SoalTest
 * @package App\Models
 * @version February 9, 2021, 7:49 am UTC
 *
 * @property string $soal
 * @property string $pilihan_a
 * @property string $pilihan_b
 * @property string $pilihan_c
 * @property string $pilihan_d
 * @property string $jawaban
 * @property string $image
 */
class SoalTest extends Model
{
    use SoftDeletes;


    public $table = 'soal_tests';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'soal',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'jawaban' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
