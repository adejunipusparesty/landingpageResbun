<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('patient_info')->nullable();
            $table->text('content');
            $table->integer('rating')->default(5);
            $table->string('avatar')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->integer('order_num')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonials');
    }
}
