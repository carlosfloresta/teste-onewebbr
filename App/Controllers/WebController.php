<?php

namespace App\Controllers;

class WebController extends Controller
{

    public function home(): void
    {
        echo $this->renderView('home');
    }

    public function validar(array $estado)
    {
        header('Content-type:application/json;charset=utf-8');
        $estadoString = $estado['estado'];
        $estadoString = strtoupper($estadoString);

        if (
            $estadoString === 'RS,RS' || $estadoString === 'RS,SC' ||
            $estadoString === 'RS,SC,PR,SP' || $estadoString === 'RS,SC,RS' ||
            $estadoString === 'AM,MT,GO' || $estadoString === 'PR,SC,RS'
        ) {

            echo json_encode(array("rota" => URL_BASE . "/trajeto/validar/$estadoString", "isValida" => true));
        } elseif ($estadoString === '' || $estadoString === 'RS' || $estadoString === 'RS,PR,SP,MG' || $estadoString === 'PR,RS') {

            echo json_encode(array("rota" => URL_BASE . "/trajeto/validar/$estadoString", "isValida" => false));
        } else {

            echo json_encode(array("codigo" => 400, "mensagem" => "Dados recebidos invalidos!"));
        }
    }

    public function error(array $data): void
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("codigo" => $data["errcode"], "mensagem" => "Pagina não encontrada!"));
    }


    public function testaAPI(string $estadoString)
    {

        if (
            $estadoString === 'RS,RS' || $estadoString === 'RS,SC' ||
            $estadoString === 'RS,SC,PR,SP' || $estadoString === 'RS,SC,RS' ||
            $estadoString === 'AM,MT,GO' || $estadoString === 'PR,SC,RS'
        ) {

            return true;
        } elseif ($estadoString === '' || $estadoString === 'RS' || $estadoString === 'RS,PR,SP,MG' || $estadoString === 'PR,RS') {

            return false;
        }
    }
}
