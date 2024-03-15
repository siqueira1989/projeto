<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class ColaboradorController extends Action {
        public function colaborador(){
            session_start();
            if(!empty ($_SESSION['id']) && !empty ($_SESSION['nome']) && $_SESSION['nivel'] == 2){
                print_r($_SESSION);
                echo 'cheguei 2';

                } else
                {
                    header('Location: /login?mensagem=erro');
                }
        }
}
