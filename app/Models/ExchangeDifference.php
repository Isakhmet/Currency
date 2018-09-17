<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeDifference extends Model
{
    protected $fillable = [
        'currency_id',
        'value',
        'change',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
