<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->double('price', 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('recurring_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('invoices');
    }
}
