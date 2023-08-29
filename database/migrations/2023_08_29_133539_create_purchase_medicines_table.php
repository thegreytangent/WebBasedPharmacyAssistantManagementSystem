<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_medicines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('purchase_id')->index();
            $table->uuid('medicine_id')->index();
            $table->float('price');
            $table->integer('qty');


            $table->timestamps();

            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchases')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('medicine_id')
                ->references('id')
                ->on('medicines')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_medicines');
    }
};
