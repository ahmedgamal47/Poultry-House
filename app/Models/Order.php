<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\WeightType;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

/**
 * @property int $id
 * @property int $buyerUserId
 * @property int $productId
 * @property float $productPrice
 * @property int $productWeight
 * @property int $productWeightType
 * @property int $quantity
 * @property string $number
 * @property string $date
 * @property int $status
 * @property float $price
 * @property User $user
 * @property Product $product
 */
class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * @var array
     */
    protected $fillable = [
        'buyerUserId',
        'productId',
        'productPrice',
        'productWeight',
        'productWeightType',
        'quantity',
        'number',
        'date',
        'status',
        'price',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get production date with specific format
     *
     * @return string
     */
    public function getDateAttribute()
    {
        return Date::parse($this->attributes['date'])->format('j F Y');
    }

    /**
     * Get order status label
     *
     * @return array|null|string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->attributes['status'] == OrderStatus::PENDING) {
            return __('messages.order_pending');
        } else if ($this->attributes['status'] == OrderStatus::IN_PROGRESS) {
            return __('messages.order_in_progress');
        } else if ($this->attributes['status'] == OrderStatus::FINISHED) {
            return __('messages.order_finished');
        } else if ($this->attributes['status'] == OrderStatus::CANCELED) {
            return __('messages.order_canceled');
        } else {
            return "";
        }
    }

    public function getIsPendingAttribute()
    {
        return $this->attributes['status'] == OrderStatus::PENDING;
    }

    public function getIsInProcessingAttribute()
    {
        return $this->attributes['status'] == OrderStatus::IN_PROGRESS;
    }

    public function getIsFinishedAttribute()
    {
        return $this->attributes['status'] == OrderStatus::FINISHED;
    }

    public function getIsCanceledAttribute()
    {
        return $this->attributes['status'] == OrderStatus::CANCELED;
    }

    /**
     * Get weight type label
     *
     * @return array|null|string
     */
    public function getProductWeightTypeLabelAttribute()
    {
        if ($this->attributes['productWeightType'] == WeightType::BY_GRAM) {
            return __('messages.gram');
        } else if ($this->attributes['productWeightType'] == WeightType::BY_KILOGRAM) {
            return __('messages.kilogram');
        } else if ($this->attributes['productWeightType'] == WeightType::BY_TON) {
            return __('messages.ton');
        } else {
            return "";
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'buyerUserId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
