<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraPersonToDirectOrders extends Migration
{
    public function up()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            $table->integer('extra_person')->default(0)->after('phone'); // Default 0 jika tidak ada
        });
    }

    public function down()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            $table->dropColumn('extra_person'); // Jika rollback, hapus kolom
        });
    }
}
