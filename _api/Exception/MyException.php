<?php

/**
 * Cria uma classe para testar a exceção
 */
class MyException {

    public $var;

    const THROW_NONE = 0;
    const THROW_CUSTOM = 1;
    const THROW_DEFAULT = 2;

    function __construct($avalue = self::THROW_NONE) {

        switch ($avalue) {
            case self::THROW_CUSTOM:
                // lança a exeção customizada
                throw new MyException('1 é um parâmetro inválido', 5);
                break;

            case self::THROW_DEFAULT:
                // throw default one.
                throw new Exception('2 não é um parâmetro permitido', 6);
                break;

            default:
                // Sem exceção, o objeto será criado
                $this->var = $avalue;
                break;
        }
    }

}
