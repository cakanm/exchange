<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 3)->index();
            $table->decimal('rate', 12, 6)->default(0);
            $table->decimal('surcharge_percent', 8, 2)->default(0);
            $table->decimal('discount_percent', 8, 2)->default(0);
            $table->boolean('send_email')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Artisan::call( 'db:seed', [
                '--class' => 'CurrencySeeder',
                '--force' => true ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
