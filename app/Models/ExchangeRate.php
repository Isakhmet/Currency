<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExchangeRate
 *
 * @package App\Models
 * @property int $id
 * @property int $company_id
 * @property int $exchange_type_id
 * @property int $currency_id
 * @property int $is_exchange
 * @property string|null $buy
 * @property string $sell
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\ExchangeType $exchangeType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereExchangeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereIsExchange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExchangeRate extends Model
{
    /**
     * @var array
     */
    protected $fillable = [

        'company_id',
        'exchange_type_id',
        'currency_id',
        'buy',
        'sell',
        'is_exchange'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exchangeType()
    {
        return $this->belongsTo(ExchangeType::class, 'exchange_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
