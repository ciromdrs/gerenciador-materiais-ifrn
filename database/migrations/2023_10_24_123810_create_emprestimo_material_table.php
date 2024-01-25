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
        Schema::create('emprestimo_material', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materiais');
            $table->unsignedBigInteger('emprestimo_id');
            $table->foreign('emprestimo_id')->references('id')->on('emprestimos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimo_material');
    }
};
