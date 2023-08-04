<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;

/**
 * Description of FornecedorController
 *
 * @author Witor
 */
use Controller\Controller;
use Controllers\EmailController;
use Controllers\TelefoneController;
use Models\FornecedorModel;
use View\View;

class FornecedorController extends Controller {

    private $id;
    private $nome;
    private $descricao;
    private $cidade;
    private $endereco;
    private $bairro;
    private $numero;
    private $emailController;
    private $telefoneController;
    private $telefones;

    public function fornecedor() {
        $model = new FornecedorModel();
        $model->listFornecedores($this);

        $email = new EmailController();
        $this->setEmail($email);
        $this->getEmail()->email($this->getId());

        $telefone = new TelefoneController();
        $this->setTelefone($telefone);
        $this->setTelefones($this->getTelefone()->telefones($this->getId()));
        View::run('fornecedor', $this->getFornecedor());
    }

    private function getFornecedor() {
        return $dados = [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'descricao' => $this->getDescricao(),
            'cidade' => $this->getCidade(),
            'endereco' => $this->getEndereco(),
            'bairro' => $this->getBairro(),
            'numero' => $this->getNumero(),
            'idEmail' => $this->getEmail()->getId(),
            'email' => $this->getEmail()->getEmail(),
            'referenciaEmail' => $this->getEmail()->getReferencia(),
            'telefones' => $this->getTelefones()
        ];
    }

    public function editFornecedor($idFornecedor) {
        $model = new FornecedorModel();
        $fornecedorEdit = $model->editFornecedor($idFornecedor);
        $fornecedorRead = $model->getDataAccess();

        if (filter_var($fornecedorEdit, FILTER_VALIDATE_BOOLEAN) === true):
            $link = redirect('fornecedor?editSuccess');
            header("Location: {$link}");
        endif;
        View::run('editFornecedor', $fornecedorRead);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getCidade(): string {
        return $this->cidade;
    }

    public function getEndereco(): string {
        return $this->endereco;
    }

    public function getBairro(): string {
        return $this->bairro;
    }

    public function getNumero(): int {
        return $this->numero;
    }

    public function getEmail() {
        return $this->emailController;
    }

    public function getTelefone() {
        return $this->telefoneController;
    }

    public function getTelefones() {
        return $this->telefones;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function setNome(string $nome) {
        (string) $this->nome = $nome;
    }

    public function setDescricao(string $descricao) {
        (string) $this->descricao = $descricao;
    }

    public function setCidade(string $cidade) {
        (string) $this->cidade = $cidade;
    }

    public function setEndereco(string $endereco) {
        (string) $this->endereco = $endereco;
    }

    public function setBairro(string $bairro) {
        (string) $this->bairro = $bairro;
    }

    public function setNumero(int $numero) {
        (int) $this->numero = $numero;
    }

    public function setEmail(EmailController $email) {
        (object) $this->emailController = $email;
    }

    public function setTelefone(TelefoneController $telefone) {
        (object) $this->telefoneController = $telefone;
    }

    public function setTelefones(array $telefones) {
        (array) $this->telefones = $telefones;
    }

}
