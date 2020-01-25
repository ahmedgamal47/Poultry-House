<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $description
 * @property string $website
 * @property float $latitude
 * @property float $longitude
 * @property int $fieldId
 * @property string $facebookLink
 * @property string $twitterLink
 * @property string $googlePlusLink
 * @property string $instagramLink
 * @property int $userId
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Category[] $categories
 */
class Company extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company';

    /**
     * @var array
     */
    protected $fillable = [
        'description',
        'website',
        'latitude',
        'longitude',
        'facebookLink',
        'twitterLink',
        'googlePlusLink',
        'instagramLink',
        'userId',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
