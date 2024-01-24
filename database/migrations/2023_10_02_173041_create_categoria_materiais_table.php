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
        Schema::create('categoria_material', function (Blueprint $table) 
        {
            // Tabela pivot NxN
            // $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('material_id')->references('id')->on('materiais');
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_material');
    }
};
