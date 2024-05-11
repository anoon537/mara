<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveGaleryIdFromPhotoPackages extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('photo_packages', function (Blueprint $table) {
            // Hapus constraint foreign key jika ada
            $table->dropForeign(['galery_id']);

            // Hapus kolom 'galery_id'
            $table->dropColumn('galery_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_packages', function (Blueprint $table) {
            // Tambahkan kembali kolom 'galery_id'
            $table->unsignedBigInteger('galery_id')->nullable();

            // Tambahkan kembali constraint foreign key
            $table->foreign('galery_id')
                ->references('id')
                ->on('galeries')
                ->onDelete('set null'); // Constraint foreign key dengan aturan penghapusan
        });
    }
}
