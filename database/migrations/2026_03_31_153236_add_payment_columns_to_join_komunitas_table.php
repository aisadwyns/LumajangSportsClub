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
        Schema::table('join_komunitas', function (Blueprint $table) {
        $table->string('order_id')->nullable()->after('id');
        $table->string('status_pembayaran')->default('pending')->after('order_id'); // 'paid', 'pending', 'cod'
        $table->string('metode_pembayaran')->nullable()->after('status_pembayaran'); // 'midtrans', 'cod'

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('join_komunitas', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'status_pembayaran', 'metode_pembayaran']);

        });
    }
};
