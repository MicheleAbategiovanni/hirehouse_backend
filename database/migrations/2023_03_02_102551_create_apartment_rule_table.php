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
        Schema::create('apartment_rule', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

             // FK ID APPARTAMENTO
             $table->unsignedBigInteger('apartment_id');
             $table->foreign('apartment_id')
                 ->references('id')
                 ->on('apartments');
 
             // FK ID RULES
             $table->unsignedBigInteger('rule_id');
             $table->foreign('rule_id')
                 ->references('id')
                 ->on('rules');
 
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_rule');
    }
};
