<?php

namespace App\Models;

use App\Enums\UserType;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $field
 * @property string $code
 * @property int $userId
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class PoultryJam extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poultry_jam';

    /**
     * @var array
     */
    protected $fillable = [
        'field',
        'code',
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
