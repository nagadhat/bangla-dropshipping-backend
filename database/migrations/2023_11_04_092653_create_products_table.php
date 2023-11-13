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
            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('sub_category_id');
            $table->string('child_category_id');
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->decimal('price');
            $table->decimal('discoutPrice')->nullable();
            $table->string('colour');
            $table->string('size');
            $table->integer('quantity');    
            $table->tinyInteger('status')->default(1);    
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
