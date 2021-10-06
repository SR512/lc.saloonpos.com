<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('gender', 20);
            $table->string('email')->unique()->nullable();
            $table->string('mobile_number')->unique();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_anniversary')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code')->nullable();
            $table->enum('job_type', ['SALARIED','COMMISSION','BOTH']);
            $table->decimal('commission_percentage')->nullable();
            $table->string('salary')->nullable();
            $table->enum('commission',['YES','NO'])->default('NO');
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
        Schema::dropIfExists('employees');
    }
}
