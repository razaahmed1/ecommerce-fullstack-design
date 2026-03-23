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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_name')->after('order_number')->nullable();
            $table->string('email')->after('customer_name')->nullable();
            $table->string('phone')->after('email')->nullable();
            $table->text('address')->after('phone')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('zip_code')->after('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'email', 'phone', 'address', 'city', 'zip_code']);
        });
    }
};
