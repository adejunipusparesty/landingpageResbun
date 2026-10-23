<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specialty');
            $table->string('category')->default('anak');
            $table->string('experience')->nullable();
            $table->text('bio')->nullable();
            $table->string('schedule_days')->nullable();
            $table->string('schedule_hours')->nullable();
            $table->string('photo')->nullable();
            $table->string('sip_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_num')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
