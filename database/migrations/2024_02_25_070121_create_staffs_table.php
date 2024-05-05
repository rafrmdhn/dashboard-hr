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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('place');
            $table->date('birth');
            $table->text('address');
            $table->string('instagram');
            $table->string('linkedin');
            $table->string('photo');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->char('village_id', 10);
            $table->foreign('village_id')
                ->references('id')
                ->on('villages')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
