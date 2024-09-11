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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('email')->nullable();
            $table->string('side_footer')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tweeter')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('instagram')->nullable();
            $table->decimal('shipping_rate')->nullable();
            $table->enum('paypal_env', ['Live', 'Testing'])->nullable();
            $table->string('paypal_client_id')->nullable();
            $table->string('paypal_secret_key')->nullable();
            $table->string('paypal_testing_client_id')->nullable();
            $table->string('paypal_testing_secret_key')->nullable();
            $table->enum('stripe_env', ['Live', 'Testing'])->nullable();
            $table->string('stripe_publishable_key')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('stripe_testing_publishable_key')->nullable();
            $table->string('stripe_testing_secret_key')->nullable();
            $table->enum('authorize_env', ['Live', 'Testing'])->nullable();
            $table->string('authorize_merchant_login_id')->nullable();
            $table->string('authorize_merchant_transaction_key')->nullable();
            $table->string('paypal_check')->nullable();
            $table->string('stripe_check')->nullable();
            $table->string('authorize_check')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
