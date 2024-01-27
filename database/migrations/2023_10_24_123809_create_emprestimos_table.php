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
            // TODO: Adicionar autorizacao_id
            // TODO: Adicionar aluno ou servidor que solicitou o empréstimo
            // TODO: Substituir 'usuario_que_emprestou' por 'quem_emprestou' e assim por diante
            $table->unsignedBigInteger('usuario_que_emprestou')->nullable();//pessoa logada no sistema
            $table->unsignedBigInteger('usuario_que_recebeu')->nullable();//aluno que pegou
            $table->unsignedBigInteger('usuario_que_devolveu')->nullable();//aluno que devolveu

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};
