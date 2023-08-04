<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ProdutoController
 *
 * @author Witor
 */

namespace Controllers;

use Controller\Controller;
use View\View;
use Models\ProdutoModel;

class ProdutoController {

    private $id;
    private $nome;
    private $descricao;

    public function produtos() {
        $model = new ProdutoModel();
        $model->listProdutos();

        $produtos = $model->getDataAccess();

        View::run('produtos', $produtos);
    }

    public function addProduto() {
        $model = new ProdutoModel();
        $addProduto = $model->addProduto();

        if (filter_var($addProduto, FILTER_VALIDATE_BOOLEAN) == true):
            $link = redirect('produtos?prodSuccess');
            header("Location: {$link}");
        endif;

        View::run('produto');
    }

    public function delProduto($idProduto) {
        $model = new ProdutoModel();
        $delProduto = $model->delProduto($idProduto);
        if (filter_var($delProduto, FILTER_VALIDATE_BOOLEAN) === true):
            $link = redirect('produtos?delSuccess');
            header("Location: {$link}");
        endif;
    }

    public function editProduto($idProduto) {

        $model = new ProdutoModel();
        $model->listProduto($idProduto);

        $produto = $model->getDataAccess();

        $editProduto = $model->editProduto($idProduto);
        if (filter_var($editProduto, FILTER_VALIDATE_BOOLEAN) === true):
            $link = redirect('produtos');
            header("Location: {$link}");
        endif;

        View::run('editProduto', $produto);
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
