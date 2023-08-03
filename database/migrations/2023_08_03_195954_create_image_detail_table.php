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
        Schema::create('image_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('object_id');
            $table->bigInteger('image_id');
            $table->bigInteger('user_id');
            $table->string('object_type');
            $table->string('object_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_detail');
    }
};
