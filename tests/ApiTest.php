<?php

namespace tests;

use App\Controllers\WebController;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{


    public function test_rotas_validas()
    {
        $service = new WebController();
        $this->assertTrue($service->testaAPI(['RS', 'RS']));
        $this->assertTrue($service->testaAPI(['RS', 'SC']));
        $this->assertTrue($service->testaAPI(['RS', 'SC', 'PR', 'SP']));
        $this->assertTrue($service->testaAPI(['RS', 'SC', 'RS']));
        $this->assertTrue($service->testaAPI(['AM', 'MT', 'GO']));
        $this->assertTrue($service->testaAPI(['PR', 'SC', 'RS']));
    }

    public function test_rotas_invalidas()
    {
        $service = new WebController();
        $this->assertFalse($service->testaAPI([]));
        $this->assertFalse($service->testaAPI(['RS']));
        $this->assertFalse($service->testaAPI(['RS', 'PR', 'SP', 'MG']));
        $this->assertFalse($service->testaAPI(['PR', 'RS']));
    }
}
