<?php /** @noinspection PhpUndefinedMethodInspection */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_links', function (Blueprint $table) {
            $table->increments('id');

            $table->text('url');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('exchange_type_id');
            $table->unsignedInteger('currency_id')->nullable();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('exchange_type_id')->references('id')->on('exchange_types');

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
        Schema::dropIfExists('company_links');
    }
}
