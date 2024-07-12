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
        Schema::create('request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_vehicle_id')->references('id')->on('request_vehicle')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            // $table->unsignedBigInteger('request_vehicle_id')->nullable();
            $table->date('request_date')->nullable();
            $table->string('name')->nullable();
            $table->string('noted')->nullable();
            $table->string('nopol')->nullable();
            $table->string('driver')->nullable();
            $table->string('status')->default('Pending')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('request_details');
        Schema::enableForeignKeyConstraints();


    }
};
