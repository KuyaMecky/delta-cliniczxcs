<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * Class Secretary
 *
 * @version February 5, 2023, 5:34 am UTC
 * @property int $id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address $address
 * @property-read User $user
 * @method static Builder|Secretary newModelQuery()
 * @method static Builder|Secretary newQuery()
 * @method static Builder|Secretary query()
 * @method static Builder|Secretary whereCreatedAt($value)
 * @method static Builder|Secretary whereId($value)
 * @method static Builder|Secretary whereUpdatedAt($value)
 * @method static Builder|Secretary whereUserId($value)
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmployeePayroll[] $payrolls
 * @property-read int|null $payrolls_count
 * @property int $is_default
 * @method static Builder|Secretary whereIsDefault($value)
 */
class Secretary extends Model
{
    /**
     * @var string
     */
    public $table = 'accountants';

    /**
     * @var array
     */
    public $fillable = [
        'user_id',
    ];

    const STATUS_ALL = 2;
    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Inactive',
    ];
    const FILTER_STATUS_ARR = [
        0 => 'All',
        1 => 'Active',
        2 => 'Inactive',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name'    => 'required',
        'last_name'     => 'required',
        'email'         => 'required|email:filter|unique:users,email',
        'password'      => 'nullable|same:password_confirmation|min:6',
        'designation'   => 'required|string',
        'qualification' => 'required|string',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'owner');
    }

    /**
     * @return MorphMany
     */
    public function payrolls()
    {
        return $this->morphMany(EmployeePayroll::class, 'owner');
    }
}
