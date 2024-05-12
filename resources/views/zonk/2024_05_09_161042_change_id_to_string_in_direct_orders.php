<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdToStringInDirectOrders extends Migration
{
    public function up()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            // Mengubah ID menjadi string dengan panjang yang sesuai
            $table->string('id', 36)->change(); // Panjang 36 untuk UUID atau format serupa
        });
    }

    public function down()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            // Mengubah kembali ke tipe integer jika rollback
            $table->bigIncrements('id')->change();
        });
    }
}
