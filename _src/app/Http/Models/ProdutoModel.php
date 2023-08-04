<?php

/**
 * Description of FornecedorModel
 *
 * @author Witor
 */

namespace Models;

use Model\Model;

class ProdutoModel extends Model {

    private $table = 'produtos';
    private $dataAccess;

    public function listProdutos() {
        $readProdutos = $this->read();
        $readProdutos->ExeRead($this->table);

        $this->setDataAccess($readProdutos->getResult());
    }

    public function listProduto($idProduto) {
        if (!$idProduto || !strip_tags(filter_var($idProduto, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;

        $readProdutos = $this->read();
        $readProdutos->ExeRead($this->table, "WHERE id = :id", "id={$idProduto}");

        $this->setDataAccess($readProdutos->getResult()[0]);
    }

    public function addProduto() {
        $postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($postData && is_array($postData)):
            $createFornecedor = $this->create();
            $createFornecedor->ExeCreate($this->table, $postData);
            if ($createFornecedor->getResult()):
                return true;
            endif;
            throw new Exception('Error ao atualizar fornecedor!');
        endif;
    }

    public function delProduto(int $idProduto) {
        if (!$idProduto || !strip_tags(filter_var($idProduto, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;

        $delProduto = $this->delete();
        $delProduto->ExeDelete($this->table, "WHERE id = :id", "id={$idProduto}");
        if (!$delProduto->getResult()):
            throw new Exception('Error ao deletar produto de id: ' . $idProduto);
        endif;
        return true;
    }

    public function editProduto($idProduto) {
        if (!$idProduto || !strip_tags(filter_var($idProduto, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;
        
        $postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($postData && is_array($postData)):
            $updateFornecedor = $this->update();
            $updateFornecedor->ExeUpdate($this->table, $postData, "WHERE id = :id", "id={$idProduto}");
            if ($updateFornecedor->getResult()):
                return true;
            endif;
            throw new Exception('Error ao atualizar fornecedor!');
        endif;
    }

    private function setDataAccess(array $data) {
        (array) $this->dataAccess = $data;
    }

    public function getDataAccess() {
        return $this->dataAccess;
    }

}
