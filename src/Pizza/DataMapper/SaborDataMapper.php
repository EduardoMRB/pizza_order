<?php

namespace Pizza\DataMapper;

use \PDO;
use Pizza\Entity\Sabor;

class SaborDataMapper
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(Sabor $sabor)
    {
        $stm = $this->pdo->prepare('
            INSERT INTO pizza_order (
                sabor, 
                preco, 
                descricao, 
                disponivel
            ) VALUES (
                :sabor, 
                :preco, 
                :descricao, 
                :disponivel
            );
        ');

        $stm->bindValue(':sabor', $sabor->getSabor(), PDO::PARAM_STR);
        $stm->bindValue(':preco', $sabor->getPreco(), PDO::PARAM_STR);
        $stm->bindValue(':descricao', $sabor->getDescricao(), PDO::PARAM_STR);
        $stm->bindValue(':disponivel', $sabor->getDisponivel(), PDO::PARAM_INT);

        if ($stm->execute()) {
            return $this->pdo->lastInsertId();
        }

        throw new \RuntimeException('Erro ao inserir sabor');
    }

    public function update(Sabor $sabor)
    {
        $stm = $this->pdo->prepare('
            UPDATE 
                pizza_order
            SET 
                sabor = :sabor,
                descricao = :descricao,
                preco = :preco,
                disponivel = :disponivel
            WHERE
                id = :id
        ');

        $stm->bindValue(':sabor', $sabor->getSabor(), PDO::PARAM_STR);
        $stm->bindValue(':preco', $sabor->getPreco(), PDO::PARAM_STR);
        $stm->bindValue(':descricao', $sabor->getDescricao(), PDO::PARAM_STR);
        $stm->bindValue(':disponivel', $sabor->getDisponivel(), PDO::PARAM_INT);
        $stm->bindValue(':id', $sabor->getId(), PDO::PARAM_INT);

        if ($stm->execute()) {
            return $sabor->getId();
        }

        throw new \RuntimeException('Erro ao alterar sabor');
    }

    public function findById($id)
    {
        $stm = $this->pdo->prepare('
            SELECT
                id, sabor, preco, descricao, disponivel
            FROM
                pizza_order
            WHERE
                id = :id
        ');

        $stm->setFetchMode(PDO::FETCH_CLASS, 'Pizza\Entity\Sabor');
        $stm->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stm->execute()) {
            $sabor = $stm->fetch();
            $stm->closeCursor();

            return $sabor;
        }
    }

    public function findAll()
    {
        $stm = $this->pdo->prepare('
            SELECT
                id, sabor, preco, descricao, disponivel
            FROM
                pizza_order
        ');

        $stm->setFetchMode(PDO::FETCH_CLASS, 'Pizza\Entity\Sabor');

        if ($stm->execute()) {
            $sabores = $stm->fetchAll();
            $stm->closeCursor();

            return $sabores;
        }

        throw new \RuntimeException('Erro ao recuperar sabores');
    }

    public function delete($id)
    {
        $stm = $this->pdo->prepare('
            DELETE FROM 
                pizza_order
            WHERE
                id = :id
        ');

        $stm->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stm->execute()) {
            return $id;
        }

        throw new \RuntimeException('Erro ao remover sabor');
    }
}
