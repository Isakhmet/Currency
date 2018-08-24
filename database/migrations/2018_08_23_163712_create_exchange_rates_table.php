<?php /** @noinspection PhpUndefinedMethodInspection */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('company_id');
            $table->unsignedInteger('exchange_type_id');
            $table->unsignedInteger('currency_id');

            // Для нацбанка у которого только один курс - если false тогда берем курс только из sell
            /** @noinspection PhpUndefinedMethodInspection */
            $table->boolean('is_exchange')->default(true);

            $table->string('buy')->nullable();
            $table->string('sell');

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('exchange_type_id')->references('id')->on('exchange_types');
            $table->foreign('currency_id')->references('id')->on('currencies');

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
        Schema::dropIfExists('exchange_rates');
    }
}
