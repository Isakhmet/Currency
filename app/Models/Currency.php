<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string|null $sign
 * @property int $count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CompanyLink[] $exchangeLinks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExchangeRate[] $exchangeRates
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereSign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'sign',
        'count'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeLinks()
    {
        return $this->hasMany(CompanyLink::class, 'currency_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeRates()
    {
        return $this->hasMany(ExchangeRate::class, 'currency_id', 'id');
    }
}
