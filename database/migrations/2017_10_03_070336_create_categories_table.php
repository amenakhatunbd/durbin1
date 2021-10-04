<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->index()->default(0)->unsigned();
            $table->string('title')->index();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('fav_icon')->nullable();
            $table->text('image_gallery')->nullable();
            $table->string('color_code')->nullable();
            $table->integer('priority')->nullable();
            $table->string('slug')->unique();
            $table->integer('views')->default(0)->unsigned();
            $table->integer('total_posts')->default(0)->unsigned();
            $table->integer('total_products')->default(0)->unsigned();
            $table->integer('is_featured')->index()->default(0)->unsigned();
            $table->integer('is_home_page')->index()->default(0)->unsigned();
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
        Schema::dropIfExists('categories');
    }
}
