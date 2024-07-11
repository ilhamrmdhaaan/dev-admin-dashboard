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
            ->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->date('request_date')->nullable();
            $table->char('name')->nullable();
            $table->string('noted')->nullable();
            $table->string('nopol')->nullable();
            $table->char('driver')->nullable();
            $table->char('status')->nullable();
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
