<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('komunitas', function (Blueprint $table) {
            $table->enum('status', ['pending', 'publish', 'unpublish'])->default('unpublish')->after('link_wa');
        });
    }

    public function down()
    {
        Schema::table('komunitas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
