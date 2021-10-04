<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderaddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderaddresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("order_id")->index();
            $table->string('name')->index()->nullable();
            $table->string('mobile')->nullable();
            $table->string('company')->index()->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip', 5)->nullable();

            $table->string('billing_name')->index()->nullable();
            $table->string('billing_mobile')->nullable();
            $table->string('billing_company')->index()->nullable();
            $table->text('billing_address')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_zip', 5)->nullable();
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');
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
        Schema::dropIfExists('orderaddresses');
    }
}
