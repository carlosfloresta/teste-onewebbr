<?php

namespace tests;

use App\Controllers\ValidarRotaController;
use App\Controllers\WebController;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{

    private $controller;

    public function setUp(): void
    {
        $this->controller = new WebController();
    }

    public function test_rotas_validas()
    {
        $service = new ValidarRotaController();
        $this->assertTrue($service->validarRota(['RS', 'RS']));
        $this->assertTrue($service->validarRota(['RS', 'SC']));
        $this->assertTrue($service->validarRota(['RS', 'SC', 'PR', 'SP']));
        $this->assertTrue($service->validarRota(['RS', 'SC', 'RS']));
        $this->assertTrue($service->validarRota(['AM', 'MT', 'GO']));
        $this->assertTrue($service->validarRota(['PR', 'SC', 'RS']));
    }

    public function test_rotas_invalidas()
    {
        $service = new ValidarRotaController();
        $this->assertFalse($service->validarRota([]));
        $this->assertFalse($service->validarRota(['RS', 'RS1']));
        $this->assertFalse($service->validarRota(['RS']));
        $this->assertFalse($service->validarRota(['RS', 'PR', 'SP', 'MG']));
        $this->assertFalse($service->validarRota(['PR', 'RS']));
    }

     public function test_validar_rota_valida() 
    {
        $service = new WebController();

        
        $service->validar(['estado' => 'RS,SC,PR']);
        $output = json_decode($this->getActualOutput(), true);

        $this->assertTrue($output['isValida']);
        
    } 

    public function test_validar_rota_invalida() 
    {
       
        $this->controller->validar(['estado' => '']);
        $output = json_decode($this->getActualOutput(), true);

        $this->assertFalse($output['isValida']);
        
    } 

    public function test_validar_rota_invalida_somente_um_estado() 
    {
        $this->controller->validar(['estado' => 'SC']);
        $output = json_decode($this->getActualOutput(), true);

        $this->assertFalse($output['isValida']);
        
    } 
}
