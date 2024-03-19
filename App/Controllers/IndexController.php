<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;


class IndexController extends Action
{

	public function index()
	{

		header('Location: /login');
	}

	public function login()
	{
		$this->view->mensagem = isset ($_GET['mensagem']) ? $_GET['mensagem'] : '';
		$this->render('login');
	}
}

?>