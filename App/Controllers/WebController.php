<?php

namespace App\Controllers;
use App\Controllers\ValidarRotaController;

class WebController extends Controller
{

    public function home(): void
    {
        echo $this->renderView('home');
    }

    public function validar(array $parametros)
    {
        $estadosString = $parametros['estado'];
        $estadoArray = explode(',', $estadosString);
        //header('Content-type:application/json;charset=utf-8');
        $validaRota = new ValidarRotaController;
        $testaAPI = $validaRota->validarRota($estadoArray);


        if(!$testaAPI) {
            echo json_encode(array("codigo" => 400, "mensagem" => "Dados recebidos invalidos!", "isValida" => false));
            return;
        }

        $estadoString = strtoupper($estadosString);
        echo json_encode(array("rota" => URL_BASE . "/trajeto/validar/$estadosString", "isValida" => true));
        
    }

    public function error(array $data): void
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("codigo" => $data["errcode"], "mensagem" => "Pagina não encontrada!"));
    }


  
}
