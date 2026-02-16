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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->references('id')->on('sections')->constrained();
            $table->unsignedBigInteger('brand_id')->nullable();

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->default('product.png');
            $table->integer('views')->default(0);
            $table->decimal('price')->unsigned()->default(0);
            $table->decimal('discount')->unsigned()->default(0);
            $table->integer('stock')->default(100);
            $table->integer('position')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('promoted')->default(false);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
