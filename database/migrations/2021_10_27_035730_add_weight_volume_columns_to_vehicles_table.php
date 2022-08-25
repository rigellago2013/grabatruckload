<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightVolumeColumnsToVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table): void {
            $table->integer('weight_capacity')->default(0);
            $table->float('volume_capacity')->default(0);
        });
    }
}
