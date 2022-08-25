<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table): void {
            $table->id();
            $table->string('plate_number');
            $table->json('or_cr_copy');
            $table->json('insurance_docs')->nullable();
            $table->json('truck_picture');
            $table->text('notes');
            $table->string('type');
            $table->string('category');
            $table->bigInteger('vehicle_group_id');
            $table->integer('deck_length')->nullable();
            $table->integer('maximum_capacity')->nullable();
            $table->string('trailer_type')->nullable();
            $table->string('truck_category')->nullable();
            $table->string('truck_type')->nullable();
            $table->timestamps();
        });

        Schema::create('vehicle_groups', function (Blueprint $table): void {
            $table->id();
            $table->bigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('vehicle_groups');
    }
}
