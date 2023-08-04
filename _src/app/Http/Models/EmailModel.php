<?php

/**
 * Description of FornecedorModel
 *
 * @author Witor
 */

namespace Models;

use Model\Model;

class EmailModel extends Model {

    private $table = 'emails';
    private $dataAccess;

    public function getListEmails(int $idFornecedor) {
        if (!$idFornecedor || !strip_tags(filter_var($idFornecedor, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;

        $readEmail = $this->read();
        $readEmail->ExeRead($this->table, "WHERE idFornecedor = :id", "id={$idFornecedor}");

        $this->setDataAccess($readEmail->getResult());
    }

    public function listEmails(\Controllers\EmailController $email, int $idFornecedor) {
        $this->getListEmails($idFornecedor);
        $email->setId($this->getDataAccess()[0]['id']);
        $email->setEmail($this->getDataAccess()[0]['email']);
        $email->setReferencia($this->getDataAccess()[0]['referencia']);
        $email->setIdFornecedor($this->getDataAccess()[0]['idFornecedor']);
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
