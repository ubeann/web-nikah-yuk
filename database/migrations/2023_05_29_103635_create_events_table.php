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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->enum('service', [
                'kilat',
                'xpress',
                'honeymoon',
                'custom'
            ]);
            $table->enum('status', [
                'pending',
                'canceled',
                'confirmed',
                'rejected',
                'completed'
            ]);
            $table->integer('price')->nullable();
            $table->date('date');
            $table->string('location');
            $table->string('description')->nullable();
            $table->string('guest_url')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->onDelete('cascade')
                ->on('users');
            //--------------------------------
            // location from google map
            // $table->string('latitude');
            // $table->string('longitude');
            //--------------------------------
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
