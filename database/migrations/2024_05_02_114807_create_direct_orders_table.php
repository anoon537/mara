<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('direct_orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('phone');
            $table->integer('extra_person')->default(0);
            $table->date('booking_date');
            $table->time('booking_time');
            $table->decimal('price', 10, 2);
            $table->foreignId('photo_package_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('completed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_orders');
    }
}
