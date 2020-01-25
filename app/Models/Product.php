<?php

namespace App\Models;

use App\Enums\WeightType;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Jenssegers\Date\Date;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property float $price
 * @property integer $weight
 * @property integer $weightType
 * @property int $companyId
 * @property string $validity
 * @property string $productionDate
 * @property string $usage
 * @property int $categoryId
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 * @property User $user
 */
class Product extends Model
{
    use  EloquentImageMutatorTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'weight',
        'weightType',
        'companyId',
        'validity',
        'productionDate',
        'usage',
        'categoryId',
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
     * Get short description
     *
     * @param $value
     * @return string
     */
    public function getShortDescriptionAttribute()
    {
        return Str::words($this->attributes['description'], 20, ' ...');
    }

    /**
     * Get weight type label
     *
     * @return array|null|string
     */
    public function getWeightTypeLabelAttribute()
    {
        if ($this->attributes['weightType'] == WeightType::BY_GRAM) {
            return __('messages.gram');
        } else if ($this->attributes['weightType'] == WeightType::BY_KILOGRAM) {
            return __('messages.kilogram');
        } else if ($this->attributes['weightType'] == WeightType::BY_TON) {
            return __('messages.ton');
        } else {
            return "";
        }
    }

    /**
     * Get production date with specific format
     *
     * @return string
     */
    public function getProductionDateAttribute()
    {
        return Date::parse($this->attributes['productionDate'])->format('j F Y');
    }

    /**
     * Get production date value
     *
     * @return string
     */
    public function getProductionDateValueAttribute()
    {
        return $this->attributes['productionDate'];
    }

    /**
     * Product default image
     *
     * @return string
     */
    public static function defaultImage()
    {
        return url('img/new-product-logo.jpg');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(User::class, 'companyId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'productId');
    }
}
