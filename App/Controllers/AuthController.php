<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	public function autenticar() {
		
		$usuario = Container::getModel('Colaboradores');

		$usuario->__set('nome_colaboradores', $_POST['usuario']);
		$usuario->__set('senha_colaboradores', $_POST['senha']);
		
		$usuario->acesso();

		
					/*echo '<pre>';
		print_r($retorno);
	echo '</pre>';*/
	if(!empty($usuario->__get('id_colaboradores'))  && !empty($usuario->__get('nivel_colaboradores')) && !empty($usuario->__get('nome_colaboradores'))) {
		session_start();

			$_SESSION['id'] = $usuario->__get('id_colaboradores');
			$_SESSION['nome'] = $usuario->__get('nome_colaboradores');
			$_SESSION['nivel'] = $usuario->__get('nivel_colaboradores');

		 if( $usuario->__get('nivel_colaboradores') == 1){
			header('Location: /admin');
			
		 } else{
			echo('nome:'.$usuario->__get('nivel_colaboradores'));
			
		 }
	} else{
		header('Location: /login?mensagem=erro');
	}
}
public function sair(){
	session_start();
	session_destroy();
	header('Location: /login');
}


}


?>