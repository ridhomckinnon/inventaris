<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_in', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->integer('supplier_id');
            $table->integer('quantity');
            $table->string('quantity_unit', 5);
            $table->string('place');
            $table->integer('cost_price');
            $table->integer('sell_price');
            $table->string('status', 10);
            $table->integer('no_in');
            $table->date('date_in');
            $table->date('date_expired');
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
        Schema::dropIfExists('item_in');
    }
};
