<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->index();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique();
//            ---------------
            $table->string('sku')->unique();
            $table->string('stock_status')->nullable();
            $table->string('tax_class')->nullable();
            $table->decimal('regular_price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->default(0);
            $table->unsignedInteger('brand_id')->index()->nullable();
            $table->string('product_qty')->nullable();
            $table->string('alert_quantity')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_model')->nullable();
            $table->integer('product_type')->nullable();
            $table->unsignedInteger('unit_id')->index()->nullable();
            $table->text('image_gallery')->nullable();
            //            ----------
            $table->unsignedInteger('author_id')->index()->nullable();
            $table->unsignedInteger('publisher_id')->index()->nullable();
            $table->string('isbn')->nullable();
            $table->date('edition_date')->nullable();
            $table->string('number_of_pages')->nullable();
            $table->unsignedInteger('country_id')->index()->nullable();
            $table->string('language')->nullable();
            //            ----------
            $table->integer('is_featured')->index()->default(0)->unsigned();
            $table->integer('views')->default(0)->unsigned();
            $table->string("seo_title")->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('modified_by')->unsigned()->nullable();
            $table->tinyInteger('status')->index()->default(2)->comment('1=active, 2=pending, 3=cancel');
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
        Schema::dropIfExists('products');
    }
}
