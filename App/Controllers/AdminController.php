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
       $this->view->colaboradores= $colaboradores-> getColaboradores();
       
         $this->render('colaborador');
    }
    /*Crud*/
    public function colaboradoresGerenciar()
    {
        $this->validaAutenticacao();
        $acao = $_POST['acao'];
       
          
       if($acao=="Cadastro"){
                $colaboradores = Container::getModel('Colaboradores');
                $ativo="Ativo";
                $colaboradores->__set('nome_colaboradores', $_POST['nome']);
                $colaboradores->__set('senha_colaboradores', $_POST['senha']);
                $colaboradores->__set('funcao_colaboradores', $_POST['funcao']);
                $colaboradores->__set('dataadmissao_colaboradores', $_POST['dataadmissao']);
                $colaboradores->__set('situacao_colaboradores', $_POST['situacao']);
                $colaboradores-> salvarColaboradores();
                $mensagem= "Cadastro Realizado com sucesso";
                header('Location: /colaboradores?mensagem='.$mensagem);
       }
       if($acao=="Excluir"){
        $colaboradores = Container::getModel('Colaboradores');
        $id= $_POST['id_colaboradores'];
        session_start();
        // Verificação  se o usuario esta logado
        if($_SESSION["id"] == $id){
            $mensagem= "Dados não pode ser excluido, usuário logado!";
         header('Location: /colaboradores?mensagem='.$mensagem);
        }else{
            $colaboradores->__set('id_colaboradores', $id);
            $colaboradores->DeletarColaboradores();
            $mensagem= "Excluido realizado com sucesso";
             header('Location: /colaboradores?mensagem='.$mensagem);
        }
       } 
       if($acao=="Atualizar"){
        $colaboradores = Container::getModel('Colaboradores');
        $id= $_POST['id'];
        if($_SESSION["id"] == $id){
            $mensagem= "Dados não pode ser atualizado, usuário logado!";
            header('Location: /colaboradores?mensagem='.$mensagem);
        } else{
            $colaboradores->__set('id_colaboradores', $id);
            $colaboradores->__set('nome_colaboradores', $_POST['nome']);
            $colaboradores->__set('senha_colaboradores', $_POST['senha']);
            $colaboradores->__set('funcao_colaboradores', $_POST['funcao']);
            $colaboradores->__set('dataadmissao_colaboradores', $_POST['dataadmissao']);
           $colaboradores->__set('situacao_colaboradores', $_POST['situacao']);
            $colaboradores->AtualizacaoColaboradores();
            $mensagem= "Atualizado realizado com sucesso";
             header('Location: /colaboradores?mensagem='.$mensagem);
        }
       }  
       $colaboradores = Container::getModel('Colaboradores');
       $this->view->colaboradores= $colaboradores-> getColaboradores();
   
        $this->render('colaborador');
      
     }
   
    // Medoto de  Acesso
    public function nivel()
    {
        $this->validaAutenticacao();
        $this->view->mensagem  = isset($_GET['mensagem'])? $_GET['mensagem']:'';
         $this->render('nivel');
    }

    public function validaAutenticacao()
    {

            session_start();
    
            if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
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
