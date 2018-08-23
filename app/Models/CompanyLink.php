<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyLink
 * @package App\Models
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
