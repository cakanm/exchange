<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('source_currency_code', 3);
            $table->string('currency_code', 3)->index();
            $table->decimal('exchange_rate', 12, 6)->default(0);
            $table->decimal('surcharge_percent', 8, 2)->default(0);
            $table->decimal('surcharge_amount', 8, 2)->default(0);
            $table->decimal('discount_percent', 8, 2)->default(0);
            $table->decimal('discount_amount', 8, 2)->default(0);
            $table->decimal('source_currency_amount', 8, 2)->default(0);
            $table->decimal('currency_amount', 8, 2)->default(0);
            $table->decimal('source_total', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
