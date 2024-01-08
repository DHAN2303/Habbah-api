<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->text('text')->nullable();
            $table->string('redirect_url')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('type')->default('banner');

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
        Schema::dropIfExists('marketing_boxes');
    }
}
