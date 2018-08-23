<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 * @package App\Models
 */
class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'created_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeLink()
    {
        return $this->hasMany(CompanyLink::class, 'company_id', 'id');
    }
}
