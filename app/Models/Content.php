<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $value
 */
class Content extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'content';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

}
