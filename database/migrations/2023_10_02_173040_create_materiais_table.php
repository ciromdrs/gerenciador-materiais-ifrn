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
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255)->unique();

            $table->timestamps();
        });
        Schema::create('categoria_material', function (Blueprint $table) 
        {
            //tabela pivot NxN
            // $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('categoria_id');
            # TODO: Remover CASCADEs
            $table->foreign('material_id')->references('id')->on('materiais');//->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('categoria_id')->references('id')->on('categorias');//->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiais');
        Schema::dropIfExists('categoria_material');
    }
};
