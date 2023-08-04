<?php

namespace Autoload;

/**
 * <b>Autoload.class.php</b> Responsavel por executar a carga automatica do sistema.
 * Realiza a inclusao e validacao das classes da aplicacao
 *
 * @version 0.1
 * @copyright (c) 2017, Witor S. Oliveira
 */
class Autoload {

    /** @var [STRING] [DEFINE O CAMINHO UNICO '_api/app'] */
    private $CLASS_DIR_APP = null;

    /** @var [STRING] [DEFINE O CAMINHO UNICO '_api/lib'] */
    private $CLASS_DIR_LIB = null;

    /** @var [STRING] [DEFINE E RETORNA CAMINHO DA CLASS_DIR + RAIZ SERVER ] */
    private $getIncludePath;

    /** @var [STRING] [DEFINE O CAMINHO RAIZ DO SERVIDOR ATE A PASTA DE CLASSES */
    private $includePath;

    /** @var [STRING] [DEFINE A NOME DA CLASSE REQUISITADA] */
    private $className;

    /** @var [STRING] [DEFINE A EXTENSAO DA CLASSE QUE SERA REQUISITADA] */
    private $classExtension;

    /** @var [STRING] [MONTA A URL ATE A CLASSE APOS SER VALIDADA E RETORNADO SUCESSO] */
    private $queryDir;

    /** @var [BOOL] [DEFINE O RETORNO DO REGISTRO DO AUTOLOAD NATIVO] */
    private $autoload;

    /** @var [null] [DEFINE O RESULTADO DA BUSCA DE DIRETORIOS E CLASSES PARA INCLUSAO] */
    private $results = null;

    /**
     * <b><__construct/b>
     * Inicia a classe de autoload
     * @param BOOL $init = [DEFINE SE A CLASSE DEVERAR SE ATIVADA -> TRUE para sim]
     */
    function __construct($init = bool) {
        if (filter_var($init, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === true):
            return __METHOD__ . $this->execute();
        else:
            die('Autoload Desligado');
        endif;
    }

    /**
     * <b>splRegister</b>
     * Inicia a function de autoload nativa do PHP registrando os metodos e validando o mesmo
     * Inicia metodos de retorno de classes e verifica se houve retorno e executa metodo de inclusao
     */
    private function splRegister() {
        (bool) $this->autoload = spl_autoload_register(function($className) {
            (string) $this->className = $className;
            $this->runDir();
            if (filter_var($this->results, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === true):
                $this->includeClass();
            else:
                die("Erro ao incluir classe {$this->className}");
            endif;
        });
        return (object) $this;
    }

    /**
     * <b>getIncludePath</b>
     * Monta a url de path com a function nativa da PHP
     */
    private function getIncludePath($classDir = string) {
        (string) $this->getIncludePath = get_include_path() . PATH_SEPARATOR . $classDir;
        return (object) $this;
    }

    /**
     * <b>setIncludePath</b>
     * Informa e inicia a url de classes do PHP
     */
    private function setIncludePath() {
        (string) $this->includePath = set_include_path($this->getIncludePath);
        return (object) $this;
    }

    /**
     * <b>setClassExtension</b>
     * Define a extensao dos arquivos php percorridos
     */
    private function setClassExtension() {
        (string) $this->classExtension = spl_autoload_extensions('.php');
        return (object) $this;
    }

    /**
     * <b>setClassDir</b> Diretorio personalizado para inicio das localizacoes das classes.
     * Realiza o inicio dos diretorios internos de classes aplicacao.
     */
    private function setClassDir() {
        (string) $this->CLASS_DIR_APP = __DIR__ . DS . '..' . DS . '..' . DS . '_api';
        (string) $this->CLASS_DIR_LIB = __DIR__ . DS . '..' . DS . '..' . DS . '_src' . DS . 'app' . DS . 'Http';
        return (object) $this;
    }

    /**
     * <b>runDir</b>
     * Executa metodos de acesso aos arquivos raiz
     */
    private function runDir() {
        $this->searchDir($this->CLASS_DIR_APP);
        $this->searchDir($this->CLASS_DIR_LIB);
    }

    /**
     * <b>searhDir</b>
     * Monta url de acesso as classes nos diretorios dinamicos e retorna a validacao
     * Retorno de true para sucesso ao encontrar CLASSE
     */
    private function searchDir($local = string) {
        if (is_dir($local)):
            $dir = opendir($local);
            while ($file = readdir($dir)):
                if ($file != "." && $file != ".." && $file != ".htaccess"):
                    $this->searchDir(($local . DIRECTORY_SEPARATOR . $file));
                    if (file_exists($local . DIRECTORY_SEPARATOR . $this->className . $this->classExtension)):
                        (string) $this->queryDir = $local . DIRECTORY_SEPARATOR . $this->className . $this->classExtension;
                        (bool) $this->results = true;
                    endif;
                    unset($file);
                endif;
            endwhile;
            closedir($dir);
            unset($dir);
        endif;
        return (object) $this;
    }

    /**
     * <b>includeClass</b>
     * Realiza a inclusao da classe, eliminando caches e aumentando a velocidade no motor PHP
     */
    private function includeClass() {
        include_once($this->queryDir);
    }

    /**
     * <b>execute</b> Executa os metodos de Registros do autoload
     * Realiza a inicializacao do autoload e registra o autoload nativo do PHP
     */
    private function execute() {
        $this->setClassDir()
                ->getIncludePath($this->CLASS_DIR_APP)
                ->setIncludePath()
                ->setClassExtension()
                ->splRegister();
    }

}
