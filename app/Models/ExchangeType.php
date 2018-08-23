<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExchangeType
 * @package App\Models
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
    public function exchangeLink()
    {
        return $this->hasMany(CompanyLink::class, 'exchange_type_id', 'id');
    }
}
