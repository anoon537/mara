<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToDirectOrders extends Migration
{
    public function up()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->after('booking_time')->nullable(); // Menambah kolom price
        });
    }

    public function down()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
