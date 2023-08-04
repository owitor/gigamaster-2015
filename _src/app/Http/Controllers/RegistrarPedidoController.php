<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;

use Controller\Controller;
use View\View;
use Models\PedidoModel;
use Models\ProdutoModel;

class RegistrarPedidoController extends Controller {

    public function registros() {
        $model = new PedidoModel();
        $model->getListPedidos();

        $pedidos['pedidos'] = $model->getDataAccess();
        $modelProdutos = new ProdutoModel();
        $modelProdutos->listProdutos();
        $pedidos['produtos'] = $modelProdutos->getDataAccess();

        View::run('registrarPedido', $pedidos);
    }

    public function addRegistro() {
        $model = new ProdutoModel();
        $model->listProdutos();
        $produtos = $model->getDataAccess();


        $modelPedido = new PedidoModel();
        $addPedido = $modelPedido->addPedido();
        if (filter_var($addPedido, FILTER_VALIDATE_BOOLEAN) === true):
            $link = redirect('registrarPedido');
            header("Location: {$link}");
        endif;

        View::run('pedido', $produtos);
    }

}
