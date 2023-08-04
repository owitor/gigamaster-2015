<?php

/**
 * Description of FornecedorModel
 *
 * @author Witor
 */

namespace Models;

use Model\Model;

class PedidoModel extends Model {

    private $table = 'pedidos';
    private $dataAccess;

    public function getListPedido(int $idPedido) {
        if (!$idPedido || !strip_tags(filter_var($idPedido, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;

        $readPedido = $this->read();
        $readPedido->ExeRead($this->table, "WHERE idFornecedor = :id", "id={$idFornecedor}");

        $this->setDataAccess($readPedido->getResult());
    }

    public function getListPedidos() {
        $readPedido = $this->read();
        $readPedido->ExeRead($this->table);

        $this->setDataAccess($readPedido->getResult());
    }

    public function addPedido() {
        $postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($postData && is_array($postData)):
            $createPedido = $this->create();
            $createPedido->ExeCreate($this->table, $postData);
            if ($createPedido->getResult()):
                return true;
            endif;
            throw new Exception('Error ao atualizar fornecedor!');
        endif;
    }

    public function editEmail($idFornecedor) {
        if (!$idFornecedor || !strip_tags(filter_var($idFornecedor, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;

        $postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($postData && is_array($postData)):
            $updateEmail = $this->update();
            $updateEmail->ExeUpdate($this->table, $postData, "WHERE idFornecedor = :id", "id={$idFornecedor}");
            if ($updateEmail->getResult()):
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
