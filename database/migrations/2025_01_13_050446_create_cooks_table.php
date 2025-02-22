<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cooks', function (Blueprint $table) {
            $table->id("cook_id"); 
            $table->string("cook_name");
            $table->float("price") ;
            $table->float("discount_price") ; 
            $table->float("rating") ;
            $table->text("about_cook");
            $table->string("cook_image");
            $table->string("gallary_images")->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('cook_parent_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->integer("cook_time");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooks');
    }
};
