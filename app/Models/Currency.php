<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * @package App\Models
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
