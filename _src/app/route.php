<?php

/**
 * Rota inicial [/]
 */
Route\Routing::get('', 'RoutesController@index');

/**
 * Rota de Fornecedor [/fornecedor]
 */
Route\Routing::get('fornecedor', 'FornecedorController@fornecedor');

/**
 * Rota de edição de Fornecedor [/editfornecedor]
 */
Route\Routing::get('editFornecedor', 'FornecedorController@editFornecedor');

/**
 * Rota de cadastro de Telefones [/editfornecedor]
 */
Route\Routing::get('telefone', 'TelefoneController@addTelefone');

/**
 * Rota de edição de Telefones [/editfornecedor]
 */
Route\Routing::get('editTelefone', 'TelefoneController@editTelefone');


/**
 * Rota de listagem de Telefones [/editfornecedor]
 */
Route\Routing::get('telefones', 'TelefoneController@listTelefones');

/**
 * Rota de delete de Telefones [/editfornecedor]
 */
Route\Routing::get('delTelefone', 'TelefoneController@delTelefone');

/**
 * Rota de listagem de emails [/editEmail]
 */
Route\Routing::get('email', 'EmailController@listEmail');

/**
 * Rota de edição de emails [/editEmail]
 */
Route\Routing::get('editEmail', 'EmailController@editEmail');



/**
 * Rota de Produtos [/produtos]
 */
Route\Routing::get('produtos', 'ProdutoController@produtos');

/**
 * Rota de deletar Produtos [/produtos]
 */
Route\Routing::get('delProduto', 'ProdutoController@delProduto');

/**
 * Rota de Produto [/produto]
 */
Route\Routing::get('produto', 'ProdutoController@addProduto');

/**
 * Rota de edição de Produto [/editProduto]
 */
Route\Routing::get('editProduto', 'ProdutoController@editProduto');


/**
 * Rota de registro de pedido
 */
Route\Routing::get('registrarPedido', 'RegistrarPedidoController@registros');

/**
 * Rota de adicionar um pedido
 */
Route\Routing::get('addPedido', 'RegistrarPedidoController@addRegistro');
