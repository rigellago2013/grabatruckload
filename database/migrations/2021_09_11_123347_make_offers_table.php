<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('state')
                ->index();
            $table->bigInteger('in_response_to')
                ->index()
                ->nullable()
                ->comment('The offer this is being made in reply to');
            $table->foreignId('user_id')
                ->comment('The owner making the offer')
                ->index();
            $table->foreignId('load_id')
                ->comment('The load the offer is being made on')
                ->index();
            $table->foreignId('vehicle_group_id')
                ->nullable()
                ->comment('The vehicle group that will be doing the transport')
                ->index();
            $table->string('currency_code', 3);
            $table->integer('offer_amount');
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
        //
    }
}
