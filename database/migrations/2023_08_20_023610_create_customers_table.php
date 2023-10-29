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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('user_id')->index();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthdate');
            $table->text('address')->nullable();

            $table->timestamps();
			
			$table->foreign('user_id')
		        ->references('id')
		        ->on('users')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
			
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
