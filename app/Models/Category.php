<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

/**
 * @property int $id
 * @property string $name
 * @property string $image
 * @property boolean $active
 * @property User[] $companies
 * @property Product[] $products
 */
class Category extends Model
{
    use EloquentImageMutatorTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'active'
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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Default image
     *
     * @return string
     */
    public static function defaultImage()
    {
        return url('img/icon1.png');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(User::class, 'company_category', 'categoryId', 'companyId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fewCompanies()
    {
        return $this->belongsToMany(User::class, 'company_category', 'categoryId', 'companyId')->limit(10);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'categoryId');
    }
}
