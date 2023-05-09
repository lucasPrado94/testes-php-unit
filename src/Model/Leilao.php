<?php

namespace Alura\Leilao\Model;

class Leilao
{
    /** @var Lance[] */
    private $lances;
    /** @var string */
    private $descricao;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance(Lance $lance)
    {
        if ($this->verificaSeUltimoLanceEhDoUsuarioLanceAtual($lance)) {
            return;
        }

        $totalLancesUsuario = $this->getTotalLancesDoUsuario($lance->getUsuario());

        if ($totalLancesUsuario >= 5) {
            return;
        }

        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    private function verificaSeUltimoLanceEhDoUsuarioLanceAtual(Lance $lance) : bool {
        
        if (!empty($this->lances) && $lance->getUsuario() == $this->lances[array_key_last($this->lances)]->getUsuario()) {
            return true;
        }

        return false;
    }

    private function getTotalLancesDoUsuario(Usuario $usuario) : int {
        return array_reduce(
            $this->lances,
            function(int $somatorioLances, Lance $lanceAtual) use ($usuario) {
                if ($lanceAtual->getUsuario() == $usuario) {
                    return $somatorioLances + 1;
                }

                return $somatorioLances;
            },
            0
        );
    }
}
