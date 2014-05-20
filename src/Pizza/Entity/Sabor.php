<?php

namespace Pizza\Entity;

class Sabor
{
    private $id;
    private $sabor;
    private $preco;
    private $descricao;
    private $disponivel;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSabor($sabor)
    {
        $this->sabor = $sabor;

        return $this;
    }

    public function getSabor()
    {
        return $this->sabor;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDisponivel($disponivel)
    {
        $this->disponivel = $disponivel;

        return $this;
    }

    public function getDisponivel()
    {
        return $this->disponivel;
    }
}
