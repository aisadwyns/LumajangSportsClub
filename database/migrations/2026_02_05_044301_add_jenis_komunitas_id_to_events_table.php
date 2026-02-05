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
        Schema::table('events', function (Blueprint $table){
            $table->foreignId('jenis_komunitas_id')->nullable()->after('user_id')->constrained('jenis_komunitas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['jenis_komunitas_id']);
            $table->dropColumn('jenis_komunitas_id');
        });
    }
};
