<?php

namespace App;

use App\Models\Category;
use App\Models\Order;
use App\Models\Video;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserType;
use App\Models\Company;
use App\Models\PoultryJam;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $address
 * @property string $phone
 * @property string $bio
 * @property string $image
 * @property int $type
 * @property boolean $active
 * @property string $email_verified_at
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property PoultryJam $poultryJam
 * @property Product[] $products
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, EloquentImageMutatorTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'bio',
        'image',
        'type',
        'active',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
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
     * Hashing the password
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        if ($value != null) {
            $this->attributes['password'] = bcrypt($value);
        } else {
            $this->attributes['password'] = null;
        }
    }

    /**
     * Default user image
     *
     * @return string
     */
    public static function defaultAvatar()
    {
        return url('img/765-default-avatar.png');
    }

    /**
     * Is user type company
     *
     * @return bool
     */
    public function isCompany()
    {
        return $this->attributes['type'] == UserType::COMPANY;
    }

    /**
     * Is user type poultry jam
     *
     * @return bool
     */
    public function isPoultryJam()
    {
        return $this->attributes['type'] == UserType::POULTRY_JAM;
    }

    /**
     * Is user type poultry jam
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->attributes['type'] == UserType::ADMINISTRATOR;
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'userId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function poultryJam()
    {
        return $this->hasOne(PoultryJam::class, 'userId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'companyId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class, 'companyId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'buyerUserId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'company_category', 'companyId', 'categoryId');
    }
}
