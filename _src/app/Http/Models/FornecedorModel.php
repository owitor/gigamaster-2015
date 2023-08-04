<?php

/**
 * Description of FornecedorModel
 *
 * @author Witor
 */

namespace Models;

use Model\Model;

class FornecedorModel extends Model {

    private $table = 'fornecedor';
    private $dataAccess;

    public function getListFornecedor() {
        $readFornecedor = $this->read();
        $readFornecedor->ExeRead($this->table);

        $this->setDataAccess($readFornecedor->getResult());
    }

    public function getFornecedor($idFornecedor) {
        $readFornecedor = $this->read();
        $readFornecedor->ExeRead($this->table, "WHERE id = :id", "id={$idFornecedor}");
        if (!$readFornecedor->getResult()):
            throw new \Exception('Error ao encontrar o fornecedor de id: ' . $idFornecedor);
        endif;
        $this->setDataAccess($readFornecedor->getResult()[0]);
    }

    public function listFornecedores(\Controllers\FornecedorController $fornecedor) {
        $this->getListFornecedor();
        $fornecedor->setId($this->getDataAccess()[0]['id']);
        $fornecedor->setNome($this->getDataAccess()[0]['nome']);
        $fornecedor->setDescricao($this->getDataAccess()[0]['descricao']);
        $fornecedor->setCidade($this->getDataAccess()[0]['cidade']);
        $fornecedor->setEndereco($this->getDataAccess()[0]['endereco']);
        $fornecedor->setBairro($this->getDataAccess()[0]['bairro']);
        $fornecedor->setNumero($this->getDataAccess()[0]['numero']);
    }

    public function editFornecedor($idFornecedor) {
        if (!$idFornecedor || !strip_tags(filter_var($idFornecedor, FILTER_SANITIZE_NUMBER_INT))):
            throw new \Exception('Informe um id(int) do fornecedor na url');
        endif;

        $readFornecedor = $this->getFornecedor($idFornecedor);
        if (!$this->getDataAccess()):
            throw new \Exception('Error ao ler fornecedor');
        endif;

        $postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($postData && is_array($postData)):
            $updateFornecedor = $this->update();
            $updateFornecedor->ExeUpdate($this->table, $postData, "WHERE id = :id", "id={$idFornecedor}");
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
