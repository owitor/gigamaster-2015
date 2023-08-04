<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;

/**
 * Description of EmailController
 *
 * @author Witor
 */
use Controller\Controller;
use Models\EmailModel;
use View\View;

class EmailController extends Controller {

    private $id;
    private $email;
    private $referencia;
    private $idFornecedor;

    public function email(int $idFornecedor) {
        $model = new EmailModel();
        $model->listEmails($this, $idFornecedor);
    }

    public function listEmail($idFornecedor) {
        $model = new EmailModel();
        $model->getListEmails($idFornecedor);

        $email = $model->getDataAccess()[0];

        View::run('email', $email);
    }

    public function editEmail($idFornecedor) {

        $model = new EmailModel();
        $model->getListEmails($idFornecedor);
        $email = $model->getDataAccess()[0];
        $emailEdit = $model->editEmail($idFornecedor);

        if (filter_var($emailEdit, FILTER_VALIDATE_BOOLEAN) === true):
            $link = redirect('fornecedor');
            header("Location: {$link}");
        endif;


        View::run('editEmail', $email);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getReferencia(): string {
        return $this->referencia;
    }

    public function getIdFornecedor(): string {
        return $this->referencia;
    }

    public function setId(int $id) {
        (int) $this->id = $id;
    }

    public function setEmail($email) {
        (string) $this->email = $email;
    }

    public function setReferencia($referencia) {
        (string) $this->referencia = $referencia;
    }

    public function setIdFornecedor(string $idFornecedor) {
        (string) $this->idFornecedor = $idFornecedor;
    }

}
