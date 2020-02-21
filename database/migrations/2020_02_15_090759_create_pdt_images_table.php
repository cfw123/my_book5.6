<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdtImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdt_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_path',200)->default('')->comment('路径');
            $table->unsignedInteger('image_no');
            $table->unsignedInteger('product_id');
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
        Schema::dropIfExists('pdt_images');
    }
}
