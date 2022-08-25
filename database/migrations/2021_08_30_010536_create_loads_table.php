<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('loads', function (Blueprint $table): void {
            $table->id();
            $table->string('code')
                ->comment('Grab reference code visible internally and externally')
                ->index()
                ->nullable();
            $table->string('internal_code')
                ->comment('Internal reference number visible internally only')
                ->nullable();
            $table->string('state');
            $table->string('load_type')
                ->default('general')
                ->comment('The load type - see the LoadTypeEnum class for values')
                ->index();
            $table->integer('weight')
                ->comment('Estimated weight of the load')
                ->nullable();
            $table->float('volume')
                ->comment('Estimated volume of the load')
                ->nullable();
            $table->foreignIdFor(\App\Models\Vehicle::class, 'vehicle_id')
                ->comment('The vehicle that has been assigned to do this load')
                ->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->timestamp('pickup_start')->nullable();
            $table->timestamp('pickup_end')->nullable();
            $table->json('pickup_equipments')->nullable();
            $table->point('pickup_location')->nullable();
            //$table->foreignIdFor(\App\Models\Address::class, 'pickup_address_id');
            $table->bigInteger('pickup_address_id')->nullable();

            $table->timestamp('delivery_start')->nullable();
            $table->timestamp('delivery_end')->nullable();
            $table->point('delivery_location')->nullable();
            $table->bigInteger('delivery_address_id')->nullable();
            //$table->foreignIdFor(\App\Models\Address::class, 'delivery_address_id');
            $table->json('delivery_equipments')->nullable();

            $table->timestamp('expiry')->nullable();
            $table->string('customer_max_currency_code')->nullable();
            $table->integer('customer_max_amount')->nullable();
            $table->boolean('wants_insurance')->default(false);
            $table->string('insurance_value_currency')->nullable();
            $table->integer('insurance_value_amount')->nullable();
            $table->boolean('insurance_terms')->nullable();
            $table->text('description')->nullable();
            $table->string('company')->nullable();
            $table->string('contact_name')->nullable();
            $table->text('instructions')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_to_notify')->nullable();
            $table->json('extra_emails')->nullable();

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
        Schema::dropIfExists('loads');
    }
}
