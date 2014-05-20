<?php

namespace Pizza\Factory;

use Slim\Http\Request;
use Pizza\Entity\Sabor;

class FromUserInput
{
    public static function build(Request $request)
    {
        $sabor = new Sabor;
        $sabor->setSabor($request->params('sabor'))
            ->setPreco($request->params('preco'))
            ->setDescricao($request->params('descricao'))
            ->setDisponivel($request->params('disponivel'));

        if ($request->params('id')) {
            $sabor->setId($request->params('id'));
        }

        return $sabor;
    }
}
