<?php

/**
 * Description of FornecedorModel
 *
 * @author Witor
 */

namespace Models;

use Model\Model;

class TelefoneModel extends Model {

    private $table = 'telefones';
    private $dataAccess;

    public function getListTelefone(int $idFornecedor) {
        $readTelefones = $this->read();
        $readTelefones->ExeRead($this->table, "WHERE idFornecedor = :id", "id={$idFornecedor}");

        $this->setDataAccess($readTelefones->getResult());
    }

    public function getTelefone(int $idTelefone) {
        if (!$idTelefone || !strip_tags(filter_var($idTelefone, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;

        $readTelefone = $this->read();
        $readTelefone->ExeRead($this->table, "WHERE id = :id", "id={$idTelefone}");
        
        $this->setDataAccess($readTelefone->getResult()[0]);
    }

    public function listTelefones(\Controllers\TelefoneController $telefone, int $idFornecedor) {
        $this->getListTelefone($idFornecedor);
        $telefone->setId($this->getDataAccess()[0]['id']);
        $telefone->setDdd($this->getDataAccess()[0]['ddd']);
        $telefone->setNumero($this->getDataAccess()[0]['numero']);
        $telefone->setReferencia($this->getDataAccess()[0]['referencia']);
        $telefone->setIdFornecedor($this->getDataAccess()[0]['idFornecedor']);
    }

    public function delTelefone($idTelefone) {
        if (!$idTelefone || !strip_tags(filter_var($idTelefone, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;

        $readTelefones = $this->read();
        $readTelefones->ExeRead($this->table);

        if ($readTelefones->getRowCount() > 1):
            $delTelefone = $this->delete();
            $delTelefone->ExeDelete($this->table, "WHERE id = :id", "id={$idTelefone}");
            if (!$delTelefone->getResult()):
                throw new Exception('Error ao deletar produto de id: ' . $idTelefone);
            endif;
        endif;
        return true;
    }

    public function addTelefone() {
        $postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($postData && is_array($postData)):
            $createTelefone = $this->create();
            $createTelefone->ExeCreate($this->table, $postData);
            if ($createTelefone->getResult()):
                return true;
            endif;
            throw new Exception('Error ao cadastrar telefone!');
        endif;
    }

    public function editTelefone($idTelefone) {
        if (!$idTelefone || !strip_tags(filter_var($idTelefone, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do telefone na url');
        endif;

        $postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($postData && is_array($postData)):
            $updateTelefone = $this->update();
            $updateTelefone->ExeUpdate($this->table, $postData, "WHERE id = :id", "id={$idTelefone}");
            if ($updateTelefone->getResult()):
                return true;
            endif;
            throw new Exception('Error ao cadastrar telefone!');
        endif;
    }

    private function setDataAccess(array $data) {
        (array) $this->dataAccess = $data;
    }

    public function getDataAccess() {
        return $this->dataAccess;
    }

}
