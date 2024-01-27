<?php

namespace App\Enums;
 
enum EstadoConservacaoEnum:string {
    case EmBomEstado = 'em_bom_estado';
    case Danificado = 'danificado';
    case EmManutencao = 'em_manutencao';
}