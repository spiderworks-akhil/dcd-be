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
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('title', array('Yes','No'))->default('No');
            $table->enum('short_description', array('Yes','No'))->default('No');
            $table->enum('detailed_description', array('Yes','No'))->default('No');
            $table->enum('icon', array('Yes','No'))->default('No');
            $table->enum('image', array('Yes','No'))->default('No');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('listing_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('listing_id');
            $table->bigInteger('media_id')->nullable();
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->mediumText('short_description')->nullable();
            $table->text('detailed_description')->nullable();
            $table->integer('priority')->default(0);
            $table->boolean('status')->default(1);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_contents');
        Schema::dropIfExists('listings');
    }
};
