<?php

namespace Alura\Leilao\Tests\Services;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarMaiorValorDeLancesEmOrdemCrescente()
    {
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
        $this->assertEquals(6000, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarMaiorValorDeLancesEmOrdemDecrescente()
    {
        // arrange - given
        // preparação do cenário para o teste
        $leilao = new Leilao("Baixo fender precision 66");

        $lucas = new Usuario("Lucas Prado");
        $marcela = new Usuario("Marcela Arantes");

        $leilao->recebeLance(new Lance($marcela, 6000));
        $leilao->recebeLance(new Lance($lucas, 3000));

        $leiloeiro = new Avaliador();

        // act - when
        // execução do código a ser testado
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        // assert - then
        // verificação se a saída é a esperada
        $this->assertEquals(6000, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarMenorValorDeLancesEmOrdemCrescente()
    {
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

        $menorValor = $leiloeiro->getMenorValor();

        // assert - then
        // verificação se a saída é a esperada
        $this->assertEquals(3000, $menorValor);
    }

    public function testAvaliadorDeveEncontrarMenorValorDeLancesEmOrdemDecrescente()
    {
        // arrange - given
        // preparação do cenário para o teste
        $leilao = new Leilao("Baixo fender precision 66");

        $lucas = new Usuario("Lucas Prado");
        $marcela = new Usuario("Marcela Arantes");

        $leilao->recebeLance(new Lance($marcela, 6000));
        $leilao->recebeLance(new Lance($lucas, 3000));

        $leiloeiro = new Avaliador();

        // act - when
        // execução do código a ser testado
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

        // assert - then
        // verificação se a saída é a esperada
        $this->assertEquals(3000, $menorValor);
    }

    public function testAvaliadorDeveBuscar3MaioresValores()
    {
        $leilao = new Leilao('Fiat 147 0KM');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 1500));
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($jorge, 1700));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getMaioresLances();
        static::assertCount(3, $maiores);
        static::assertEquals(2000, $maiores[0]->getValor());
        static::assertEquals(1700, $maiores[1]->getValor());
        static::assertEquals(1500, $maiores[2]->getValor());
    }
}
