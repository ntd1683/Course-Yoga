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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('course_id');
            $table->string('link_embedded');
            $table->longText('description')->nullable();
            $table->bigInteger('user_id');
            $table->string('image')->nullable();
            $table->bigInteger('view')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('accepted')->default(false);
            $table->timestamp('publish_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
