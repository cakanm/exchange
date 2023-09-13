<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Content
 *
 * @mixin Builder
 */
class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'rate',
        'surcharge_percent',
        'discount_percent',
        'send_email',
        'is_active',
    ];
}
