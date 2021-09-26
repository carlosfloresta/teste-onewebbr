# Teste para vaga OneWebBR

## descricão

Prova para programadores PHP
O objetivo dessa prova é construir um projeto do zero com composer usando PSR-4 e PHPUnit para testes unitários e de integração.

O projeto deve conter uma API REST com a seguinte rota:

A rota /trajeto/validar aceita uma requisição GET contendo uma query string com um campo de nome rota com siglas de estados separados por vírgula, exemplo: RS,SC,PR. Essa rota /trajeto/validar deve retornar um JSON no formato:
{
 "rota": "ROTA_ORIGINAL_AQUI", 
 "isValida": boolean
}
Caso a rota não receba um parâmetro válido (sigla inexistente de estado, quantidade insuficiente de estados ou não existência do campo rota) deve retornar http status 400 e um json no formato:
{
 "codigo": CODIGO_DO_ERRO,
 "mensagem": "MENSAGEM DE ERRO"
}
Você pode usar qualquer framework ou nenhum se preferir, para construir a API REST.
Os testes unitários usando PHPUnit devem validar uma determinada rota, retornando true ou false. A seguinte interface é sugerida:

    public function test_rotas_validas()
    {
        $service = new ValidarRotaService();
        $this->assertTrue($service->isValida(['RS', 'RS']));
        $this->assertTrue($service->isValida(['RS', 'SC']));
        $this->assertTrue($service->isValida(['RS', 'SC', 'PR', 'SP']));
        $this->assertTrue($service->isValida(['RS', 'SC', 'RS']));
        $this->assertTrue($service->isValida(['AM', 'MT', 'GO']));
        $this->assertTrue($service->isValida(['PR', 'SC', 'RS']));
    }

    public function test_rotas_invalidas()
    {
        $service = new ValidarRotaService();
        $this->assertFalse($service->isValida([]));
        $this->assertFalse($service->isValida(['RS']));
        $this->assertFalse($service->isValida(['RS', 'PR', 'SP', 'MG']));
        $this->assertFalse($service->isValida(['PR', 'RS']));
    }
Já os testes de integração devem garantir que o controller da API REST funciona, ou seja:

Ao fazer uma requisição GET válida para /trajeto/validar deve validar se :

o status code é 200
a resposta é um json
Ao fazer uma requisição inválida para /trajeto/validar deve validar se :

o status code é 400
a resposta é um json
Informações sobre validação de rota
A validação da rota é algo comum em sistemas de MDF-e, onde o cliente deverá informar uma rota válida do veículo entre estados. Rotas validas são aquelas que:

Ocorrem dentro do estado. Exemplo: RS,RS. Ocorre quando a origem e destino são no mesmo estado.
Os estados devem ser vizinhos. Por exemplo, a rota RS,SC,PR é válida porque RS faz divisa com SC que por sua vez faz divisa com PR. A rota RS,PR,SP não é válida pois RS não faz divisa com PR.
Execução dos testes
Deve ser possível executar os testes rodando composer test

Versão do PHP e Análise Estática
A Versão mínima do PHP deve ser a 7.4 ou 8. Use type hint em todo o projeto.
Use o PHPStan no nível mínimo 6 na pasta src e tests
Deve ser possível rodar o phpstan com o comando composer stan sem erros
FRONT END
Você deve criar uma página onde podemos acessar via navegador e informar através de um input uma rota e verificar via ajax consumindo a api se ela é válida ou não. Use a API Javascript fetch para tal.