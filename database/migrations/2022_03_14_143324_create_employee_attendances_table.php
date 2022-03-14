<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('month', 20);
            $table->date('date');
            $table->integer('day');
            $table->string('employee_id', 30);
            $table->string('employee_name');
            $table->string('department');
            $table->time('first_in_time');
            $table->time('last_out_time');
            $table->integer('hours_of_work');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_attendances');
    }
};
