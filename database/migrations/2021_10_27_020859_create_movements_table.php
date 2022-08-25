<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('movements', function (Blueprint $table): void {
            $table->id();
            $table->point('pickup');
            $table->timestampTz('pickup_start')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestampTz('pickup_end')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->point('destination');
            $table->timestampTz('destination_start')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestampTz('destination_end')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignIdFor(\App\Models\Address::class, 'pickup_address_id')
                ->comment('The address that has been assigned to do this movement.')
                ->nullable();
            $table->foreignIdFor(\App\Models\Address::class, 'destination_address_id')
                ->comment('The address that has been assigned to do this movement.')
                ->nullable();
            $table->multiPoint('path')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('movement_vehicle_group', function (Blueprint $table): void {
            $table->bigInteger('movement_id');
            $table->bigInteger('vehicle_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
        Schema::dropIfExists('movement_vehicle_group');
    }
}
