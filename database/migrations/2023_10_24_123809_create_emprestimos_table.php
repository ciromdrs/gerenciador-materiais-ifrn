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
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('usuario_que_autorizou');
            $table->unsignedBigInteger('usuario_que_emprestou')->nullable();//pessoa logada no sistema
            $table->unsignedBigInteger('usuario_que_recebeu')->nullable();//aluno que pegou
            $table->unsignedBigInteger('usuario_que_devolveu')->nullable();//aluno que devolveu

            $table->string('estado_emprestimo',255)->nullable();
            $table->string('estado_devolucao',255)->nullable();
            
            $table->timestamps();
        });

        Schema::create('emprestimo_item', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('itens')->onDelete('no action')->onUpdate('CASCADE');
            $table->unsignedBigInteger('emprestimo_id');
            $table->foreign('emprestimo_id')->references('id')->on('emprestimos')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
        Schema::dropIfExists('emprestimo_item');
    }
};
