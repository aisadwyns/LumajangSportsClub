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
        Schema::table('lscteams', function (Blueprint $table) {
            $table->foreignID('user_id')->nullable()->after('id')->constrained('users')->nullonDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lscteams', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
