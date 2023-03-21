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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('cover_img')->nullable()->default('apartment_images/house_default.png');
            $table->string('title');
            $table->tinyInteger('num_rooms')->nullable();
            $table->tinyInteger('num_beds')->nullable();
            $table->tinyInteger('num_bathrooms')->nullable();
            $table->smallInteger('square_meters')->nullable();
            $table->string('full_address');
            $table->boolean('visibile')->default(1);
            $table->float('price', 8, 2);
            $table->text('description')->nullable();
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->float('latitude', 20, 10)->nullable();
            $table->float('longitude', 20, 10)->nullable();

            // FK User_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
