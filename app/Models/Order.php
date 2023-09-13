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
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_currency_code',
        'currency_code',
        'exchange_rate',
        'surcharge_percent',
        'surcharge_amount',
        'discount_percent',
        'discount_amount',
        'source_currency_amount',
        'currency_amount',
        'source_total',
    ];
}
