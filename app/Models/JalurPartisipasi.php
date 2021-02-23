<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class JalurPartisipasi
 * @package App\Models
 * @version February 23, 2021, 7:53 am UTC
 *
 * @property string $participate
 */
class JalurPartisipasi extends Model
{
    use SoftDeletes;


    public $table = 'jalur_partisipasis';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'participate'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'participate' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
