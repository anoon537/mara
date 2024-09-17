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
        Schema::table('direct_orders', function (Blueprint $table) {
            $table->decimal('dp_amount', 10, 2)->nullable()->after('price'); // Tambah kolom dp_amount
        });
    }

    public function down()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            $table->dropColumn('dp_amount');
        });
    }
};
