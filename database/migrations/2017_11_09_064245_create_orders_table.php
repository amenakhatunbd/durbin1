<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string("invoice_no")->nullable();
            $table->dateTime("create_date")->nullable();
            $table->unsignedInteger("user_id")->index();
            $table->string("customer_name")->nullable();
            $table->string("contact_email")->nullable();
            $table->longText("cart_json")->nullable();
            $table->float("gross_amount", 10, 2);
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed');
            $table->integer("input_discount")->nullable();
            $table->float("discount", 5, 2)->nullable();
            $table->string("coupon_code")->nullable();
            $table->float("coupon_amount", 6, 2)->default(0);
            $table->float("tax", 6, 2)->default(0);
            $table->string("baseCurrency")->nullable();
            $table->string("currency")->nullable();
            $table->float("currencyRate", 6, 2)->default(0);
            $table->string("currency_symbol")->nullable();
            $table->float("grand_total", 10, 2)->index();
            $table->float("paid", 10, 2)->index();
            $table->unsignedInteger("payment_method_id")->index()->nullable();
            $table->string("shipping_method_name")->nullable();
            $table->string("shipping_method_charge")->nullable();
            $table->text("order_note")->nullable();
             $table->integer("created_by", false, true);
            $table->integer('modified_by', false, true)->nullable();
            $table->tinyInteger('order_status')->index()->default(3)
                ->comment('1=Completed, 2=Processing, 3=Pending, 4=Cancelled');
            $table->tinyInteger('payment_status')->index()->default(3)
                ->comment('1=Completed, 2=Pending, 3=Cancelled');
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
}
