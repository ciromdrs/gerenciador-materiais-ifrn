<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->id();

            // Estado de conservação
            $table->string('estado_conservacao', 255);

            $table->boolean('disponibilidade')->default(true)->nullable();

            $table->timestamps();

            $table->text('foto')->nullable();

            $table->unsignedBigInteger('local_id');
            $table->foreign('local_id')->references('id')->on('locais');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materiais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens');
    }
};
