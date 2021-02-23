<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Jalur
 * @package App\Models
 * @version February 9, 2021, 7:46 am UTC
 *
 * @property string $jalur
 */
class Jalur extends Model
{
    use SoftDeletes;


    public $table = 'jalurs';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'jalur'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'jalur' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public function jalur_partisipasi()
    {
        return $this->hasMany(\App\Models\JalurPartisipasi::class, 'jalur_id', 'id');
    }
}
