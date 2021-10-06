<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->date('invoicedate')->nullable();
            $table->date('duedate')->nullable();
            $table->text('items')->nullable();
            $table->decimal('subtotal',10,2)->nullable();
            $table->decimal('tax',10,2)->nullable();
            $table->enum('discount_type',['FLAT','%'])->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('discount_value',10,2)->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->string('paid')->nullable();
            $table->string('due')->nullable();
            $table->text('note')->nullable();
            $table->enum('method',['CASH','CHEQUE','CARD','ONLINE'])->nullable();
            $table->enum('status',['PARTIALLY_PAID','UNPAID','PENDING','CANCELLED','PAID'])->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
