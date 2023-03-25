<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

// arrange - given
// preparação do cenário para o teste
$leilao = new Leilao("Baixo fender precision 66");

$lucas = new Usuario("Lucas Prado");
$marcela = new Usuario("Marcela Arantes");

$leilao->recebeLance(new Lance($lucas, 3000));
$leilao->recebeLance(new Lance($marcela, 6000));

$leiloeiro = new Avaliador();

// act - when
// execução do código a ser testado
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

// assert - then
// verificação se a saída é a esperada
$valorEsperado = 6000;

if ($maiorValor == $valorEsperado) {
    echo "TESTE OK";
} else {
    echo "TESTE FALHOU";
}