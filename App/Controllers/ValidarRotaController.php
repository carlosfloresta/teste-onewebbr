<?php

namespace App\Controllers;

class ValidarRotaController{

    public function validarRota(array $estadosDaRota): bool
    {

        $mapaVizinhos = include 'estados.php';
        if (count($estadosDaRota) < 2) {
            return false;
        }

        //RS,SC
        for ($i = 1; $i < count($estadosDaRota); $i++) {

            $keyEstados = array_keys($mapaVizinhos);
            $estadoAtual = $estadosDaRota[$i - 1];
            $isValido = array_search($estadoAtual, $keyEstados);

            if ($isValido === false) {
                return false;
            }

            $proximoEstado = $estadosDaRota[$i];

            $vizinhosEstadoAtual = $mapaVizinhos[$estadoAtual];

            return array_search($proximoEstado, $vizinhosEstadoAtual) !== false;
        }
    }

}