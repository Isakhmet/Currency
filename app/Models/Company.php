<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CompanyLink[] $exchangeLinks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExchangeRate[] $exchangeRates
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'created_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeLinks()
    {
        return $this->hasMany(CompanyLink::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeRates()
    {
        return $this->hasMany(ExchangeRate::class, 'company_id', 'id');
    }
}
