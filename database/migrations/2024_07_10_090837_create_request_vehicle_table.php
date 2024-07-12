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
        Schema::create('request_vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->date('request_date')->nullable();
            $table->string('maximum_person')->nullable();
            $table->string('division')->nullable();
            $table->string('direction')->nullable();
            $table->text('necessity')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_vehicle');
    }
};
