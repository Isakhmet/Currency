<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyLink
 *
 * @package App\Models
 * @property int $id
 * @property string $url
 * @property int $company_id
 * @property int $exchange_type_id
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\ExchangeType $exchangeType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyLink whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyLink whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyLink whereExchangeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyLink whereUrl($value)
 * @mixin \Eloquent
 */
class CompanyLink extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'url',
        'company_id',
        'exchange_type_id',
        'currency_id'
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
