<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends Model
{
    use EloquentImageMutatorTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * The photo fields should be listed here.
     *
     * @var array
     */
    protected $image_fields = [
        'image',
    ];

    /**
     * Get post summary
     *
     * @return string
     */
    public function getSummaryAttribute()
    {
        return Str::words($this->attributes['description'], 10);
    }
}
