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
class Minat extends Model
{
    use SoftDeletes;


    public $table = 'minats';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'minat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'minat' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
