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
    public function exchangeLink()
    {
        return $this->hasMany(CompanyLink::class, 'currency_id', 'id');
    }
}
