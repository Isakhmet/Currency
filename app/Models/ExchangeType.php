<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExchangeType
 *
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CompanyLink[] $exchangeLinks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExchangeRate[] $exchangeRates
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExchangeType extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeLinks()
    {
        return $this->hasMany(CompanyLink::class, 'exchange_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeRates()
    {
        return $this->hasMany(ExchangeRate::class, 'exchange_type_id', 'id');
    }
}
