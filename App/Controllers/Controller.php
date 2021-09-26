<?php
namespace App\Controllers;

use \League\Plates\Engine;

abstract class Controller
{
    /**
     * @var \League\Plates\Engine
     */
    protected $templates;

    public function __construct()
    {
        $this->templates = Engine::create(__DIR__ . "/../../views", "php");
    }

    protected function renderView(string $viewname, array $variables = [])
    {
        return $this->templates->render($viewname, $variables);
    }
}
