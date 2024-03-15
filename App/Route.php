<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);
		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'indexController',
			'action' => 'login'
		);
		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);
		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);
		
		$routes['admin'] = array(
			'route' => '/admin',
			'controller' => 'AdminController',
			'action' => 'admin'
		);

		
		// Rotas de Colaboradores
		$routes['colaboradores'] = array(
			'route' => '/colaboradores',
			'controller' => 'AdminController',
			'action' => 'colaboradores'
		);
		$routes['colaboradoresGerenciar'] = array(
			'route' => '/colaboradoresGerenciar',
			'controller' => 'AdminController',
			'action' => 'colaboradoresGerenciar'
		);
		
		//Gerenciamento de  horarios de funcionarios
		$routes['gerenciarfuncionario'] = array(
			'route' => '/gerenciarfuncionario',
			'controller' => 'AdminController',
			'action' => 'gerenciarfuncionario'
		);
		$this->setRoutes($routes);
	}

}

?>