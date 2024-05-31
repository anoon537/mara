<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDirectOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            // Hapus kolom yang tidak diperlukan
            $table->dropForeign(['photo_package_id']);
            $table->dropColumn('photo_package_id');

            // Tambahkan kolom untuk paket
            $table->string('paket');

            // Tambahkan kolom untuk harga dengan default value
            $table->decimal('harga', 10, 2)->default(0);

            // Menambahkan kolom price dengan default value
            $table->decimal('price', 10, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('direct_orders', function (Blueprint $table) {
            // Kembalikan kolom photo_package_id
            $table->foreignId('photo_package_id')->constrained()->onDelete('cascade');

            // Hapus kolom paket dan harga
            $table->dropColumn('paket');
            $table->dropColumn('harga');
        });
    }
}
