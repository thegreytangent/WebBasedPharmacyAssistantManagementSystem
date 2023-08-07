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
        Schema::create('medicines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id')->index();
            $table->uuid('supplier_id')->index();
            $table->string('medicine_name');
            $table->timestamps();


            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
