<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AdminController extends Action
{
    public function admin()
    {
        $this->validaAutenticacao();

        $this->render('admin');
    }
    /*Colaboradores*/
    public function colaboradores()
    {
        $this->validaAutenticacao();
        $colaboradores = Container::getModel('Colaboradores');
        $this->view->colaboradores = $colaboradores->getColaboradores();

        $this->render('colaborador');
    }
    /*Crud*/
    public function colaboradoresGerenciar()
    {
        $this->validaAutenticacao();
        $acao = $_POST['acao'];


        if ($acao == "Cadastro") {
            $colaboradores = Container::getModel('Colaboradores');
            $ativo = "Ativo";
            $colaboradores->__set('nome_colaboradores', $_POST['nome']);
            $colaboradores->__set('senha_colaboradores', $_POST['senha']);
            $colaboradores->__set('funcao_colaboradores', $_POST['funcao']);
            $colaboradores->__set('dataadmissao_colaboradores', $_POST['dataadmissao']);
          
            $colaboradores->__set('situacao_colaboradores', $_POST['situacao']);
            $colaboradores->__set('nivel_colaboradores', $_POST['nivel']);
            $colaboradores->salvarColaboradores();
            // Dentro dos blocos if onde as ações são executadas com sucesso, adicione o seguinte código para definir uma mensagem de sucesso na sessão:
                $_SESSION['mensagem'] = "Colaborador cadastro com sucesso!";
                echo json_encode(['mensagem' => $_SESSION['mensagem']]);
                header('Location: /colaboradores');
                exit();
        }
        if ($acao == "Excluir") {
            $colaboradores = Container::getModel('Colaboradores');
            $id = $_POST['id_colaboradores'];
            
            // Verificação  se o usuario esta logado
            if ($_SESSION["id"] == $id) {
                $_SESSION['mensagem'] = "Não pode excluir proprio dados!";
                echo json_encode(['mensagem' => $_SESSION['mensagem']]);
                header('Location: /colaboradores');
                exit();
            } else {
                $colaboradores->__set('id_colaboradores', $id);
                $colaboradores->DeletarColaboradores();
                $_SESSION['mensagem'] = "Excluido com sucesso!";
                echo json_encode(['mensagem' => $_SESSION['mensagem']]);
                header('Location: /colaboradores');
                exit();
            }
        }
        if ($acao == "Atualizar") {
            $colaboradores = Container::getModel('Colaboradores');
            $id = $_POST['id'];
            if ($_SESSION["id"] == $id) {
                $_SESSION['mensagem'] = "Não pode excluir próprio dados"; // Substitua "Ação realizada com sucesso" pela mensagem desejada
                header('Location: /colaboradores');
            } else { 
               
                $funcao1 = $_POST['id'];
                $funcao2 = $_POST['nome'];
                $funcao3= $_POST['senha'];
                $funcao4 = $_POST['dataadmissao'];
                $funcao5 = $_POST['funcao'];
                $funcao6 = $_POST['situacao'];
                $funcao7 = $_POST['nivel'];
               
                $colaboradores->__set('id_colaboradores', $funcao1);//ok
             $colaboradores->__set('nome_colaboradores', $funcao2);
                 $colaboradores->__set('senha_colaboradores', $funcao3);
              $colaboradores->__set('funcao_colaboradores', $funcao5);
                 $colaboradores->__set('dataadmissao_colaboradores', date_format(date_create($funcao4), 'Y-m-d'));
                 $colaboradores->__set('funcao_colaboradores', $funcao5);
                 $colaboradores->__set('situacao_colaboradores', $funcao6);
               $colaboradores->__set('nivel_colaboradores', $funcao7);
                
          $colaboradores->AtualizacaoColaboradores();
           $_SESSION['mensagem'] = "Colaborador atualizado com sucesso!";
           echo json_encode(['mensagem' => $_SESSION['mensagem']]);
         header('Location: /colaboradores');
     exit();
            }
        }
        $colaboradores = Container::getModel('Colaboradores');
        $this->view->colaboradores = $colaboradores->getColaboradores();

        $this->render('colaborador');
    }

    // Medoto de  Acesso
    public function nivel()
    {
        $this->validaAutenticacao();
        $this->view->mensagem  = isset($_GET['mensagem']) ? $_GET['mensagem'] : '';
        $this->render('nivel');
    }

    public function validaAutenticacao()
    {

        session_start();

        if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
            header('Location:  /login?mensagem=erro');
        }
    }
    // public function classificacao()
    // {
    //     $this->validaAutenticacao();
    //     $classificacao = Container::getModel('Classificacao');

    //     //Declaracao de variaveis de paginaçao

    //      $totalregistrosporpagina = 7;

    //      $pagina = isset($_GET['pagina'])? $_GET['pagina']:1;
    //      $this->view->mensagem  = isset($_GET['mensagem'])? $_GET['mensagem']:'';
    //     $deslocamento = ($pagina-1)*$totalregistrosporpagina;

    //      $this->view->classificacaos=$classificacao-> listarporpagina($totalregistrosporpagina, $deslocamento);
    //      $totalregistro = $classificacao->TotalregistroClassificacao();

    //     $this->view->totalpagina=ceil($totalregistro['total']  / $totalregistrosporpagina);

    //     //Ativando o link
    //      $this->view->paginativa= $pagina;



    //      //pagina
    //      $this->render('classificacao');
    // }


    // public function cadastroclassificacao(){
    //     $classificacao = Container::getModel('Classificacao');

    // 	$classificacao->__set('idclassificacao', $_POST['idclassificacao']);
    // 	$classificacao->__set('classificacao', $_POST['classificacao']);
    //     $deletar = ($_POST['acao']);


    //     if($deletar =="deletar"){
    //     $classificacao->DeletarClassificacao();
    //     header('Location: /classificacao?mensagem=excluido');
    //     }else{
    //                 if($classificacao->__get('idclassificacao')== ""){
    //                 $buscar = $classificacao->classificacaoPorclassificacao();


    //                     if($buscar == ''){
    //                         $classificacao->salvarclassificacao();

    //                         header('Location: /classificacao?mensagem=ok');

    //                     } else {

    //                         header('Location: /classificacao?mensagem=erro');
    //                     }

    //                 }else{
    //                     $classificacao->Atualizacaoclassificacao();
    //                     header('Location: /classificacao?mensagem=Atualizado');
    //                 }
    //         }

    // }
}
