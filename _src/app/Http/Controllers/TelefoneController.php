<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;

/**
 * Description of TelefoneController
 *
 * @author Witor
 */
use Models\TelefoneModel;
use View\View;

class TelefoneController {

    private $id;
    private $ddd;
    private $numero;
    private $referencia;
    private $idFornecedor;

    public function telefones(int $idFornecedor) {
        $model = new TelefoneModel();
        $model->listTelefones($this, $idFornecedor);
        return $model->getDataAccess();
    }

    public function listTelefones($idFornecedor) {
        $model = new TelefoneModel();
        $model->getListTelefone($idFornecedor);

        $telefones = $model->getDataAccess();

        View::run('telefones', $telefones);
    }

    public function delTelefone($idTelefone) {
        $model = new TelefoneModel();
        $delProduto = $model->delTelefone($idTelefone);
        if (filter_var($delProduto, FILTER_VALIDATE_BOOLEAN) === true):
            $link = redirect('fornecedor');
            header("Location: {$link}");
        endif;
    }

    public function addTelefone() {
        $modelFornecedor = new \Models\FornecedorModel;
        $modelFornecedor->getListFornecedor();
        $fornecedor = $modelFornecedor->getDataAccess()[0];

        $model = new TelefoneModel();
        $addTelefone = $model->addTelefone();

        if (filter_var($addTelefone, FILTER_VALIDATE_BOOLEAN) == true):
            $link = redirect('fornecedor');
            header("Location: {$link}");
        endif;

        View::run('telefone', $fornecedor);
    }

    public function editTelefone(int $idTelefone) {
        $model = new TelefoneModel();
        $model->getTelefone($idTelefone);

        $editTelefone = $model->editTelefone($idTelefone);
        $telefone = $model->getDataAccess();

        if (filter_var($editTelefone, FILTER_VALIDATE_BOOLEAN) == true):
            $link = redirect('fornecedor');
            header("Location: {$link}");
        endif;

        View::run('editTelefone', $telefone);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDdd(): string {
        return $this->ddd;
    }

    public function getNumero(): string {
        return $this->numero;
    }

    public function getReferencia(): string {
        return $this->referencia;
    }

    public function getIdFornecedor(): int {
        return $this->idFornecedor;
    }

    public function setId(int $id) {
        (int) $this->id = $id;
    }

    public function setDdd(string $ddd) {
        (string) $this->ddd = $ddd;
    }

    public function setNumero(string $numero) {
        (string) $this->numero = $numero;
    }

    public function setReferencia(string $referencia) {
        (string) $this->referencia = $referencia;
    }

    public function setIdFornecedor(int $referencia) {
        (int) $this->idFornecedor = $referencia;
    }

}
