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

        $estados = include '../estados.php';
        $estadoArray = explode(',', strtoupper($estado['estado']));

        if (empty($estadoArray) || count($estadoArray) < 2) {
            $result = false;
        }

        for ($i = 1; $i < count($estadoArray); $i++) {

            $estadosKey = array_keys($estados);
            $comparaEstados = array_search($estadoArray[$i - 1], $estadosKey);

            if ($comparaEstados !== false) {
                $comparaNovamente = $estados[$estadosKey[$comparaEstados]];
                if (array_search($estadoArray[$i], $comparaNovamente) !== false) {
                    $result = true;
                } else {
                    $result = false;
                    break;
                }
            } else {

                $result = 400;
                break;
            }
        }

        $estadoString = $estado['estado'];
        $estadoString = strtoupper($estadoString);

        if ($result === true || $result === false) {
            echo json_encode(array("rota" => URL_BASE . "/trajeto/validar/$estadoString", "isValida" => $result));
        } elseif ($result === 400) {
            echo json_encode(array("codigo" => $result, "mensagem" => "Dados recebidos invalidos!"));
        }
    }

    public function error(array $data): void
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("codigo" => $data["errcode"], "mensagem" => "Pagina não encontrada!"));
    }


    public function testaAPI(array $estadoArray)
    {

        $estados = include 'estados.php';
        if (empty($estadoArray) || count($estadoArray) < 2) {
            return false;
        }

        for ($i = 1; $i < count($estadoArray); $i++) {

            $keyEstados = array_keys($estados);
            $comparaEstados = array_search($estadoArray[$i - 1], $keyEstados);

            if ($comparaEstados !== false) {
                if (array_search($estadoArray[$i], $estados[$keyEstados[$comparaEstados]]) !== false) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
