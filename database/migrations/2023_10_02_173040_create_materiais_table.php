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
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nome', 255)->unique();

            // Estado de conservação
            $table->string('estado_conservacao', 255);

            $table->text('foto')->nullable();

            $table->unsignedBigInteger('local_id');
            $table->foreign('local_id')->references('id')->on('locais');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_material');
        Schema::dropIfExists('materiais');
    }
};
