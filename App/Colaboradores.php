<?php

namespace App\Models;

use MF\Model\Model;

class Colaboradores extends Model {

	private $id_colaboradores;
	private $nome_colaboradores;
	private $senha_colaboradores;
	private $funcao_colaboradores;
	private $dataadmissao_colaboradores;
	private $situacao_colaboradores;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	//salvar
	public function salvarColaboradores() {
		$query = "INSERT INTO colaboradores (
			nome_colaboradores,
			senha_colaboradores, 
			funcao_colaboradores,
			dataadmissao_colaboradores,
			situacao_colaboradores
		) VALUES (
			:nome_colaboradores, 
			:senha_colaboradores,
			:funcao_colaboradores, 
			:dataadmissao_colaboradores,
			:situacao_colaboradores)";
		

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome_colaboradores', $this->__get('nome_colaboradores'));
		$stmt->bindValue(':senha_colaboradores', $this->__get('senha_colaboradores')); //md5() -> hash 32 caracteres
		$stmt->bindValue(':funcao_colaboradores', $this->__get('funcao_colaboradores'));
		$stmt->bindValue(':dataadmissao_colaboradores', $this->__get('dataadmissao_colaboradores'));
		$stmt->bindValue(':situacao_colaboradores', $this->__get('situacao_colaboradores'));
		$stmt->execute();

		return $this;
	}
	   // Atualizar
	   public function AtualizacaoColaboradores() {
        $query = "UPDATE colaboradores SET 
            nome_colaboradores = :nome_colaboradores,
            senha_colaboradores = :senha_colaboradores,
            funcao_colaboradores = :funcao_colaboradores,
            dataadmissao_colaboradores = :dataadmissao_colaboradores,
            situacao_colaboradores = :situacao_colaboradores
            WHERE id_colaboradores = :id_colaboradores";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_colaboradores', $this->__get('id_colaboradores'));
        $stmt->bindValue(':nome_colaboradores', $this->__get('nome_colaboradores'));
        $stmt->bindValue(':senha_colaboradores', $this->__get('senha_colaboradores'));
        $stmt->bindValue(':funcao_colaboradores', $this->__get('funcao_colaboradores'));
        $stmt->bindValue(':dataadmissao_colaboradores', $this->__get('dataadmissao_colaboradores'));
        $stmt->bindValue(':situacao_colaboradores', $this->__get('situacao_colaboradores'));
        $stmt->execute();

        return $this;
    }

	//validar se um cadastro pode ser feito
	public function validarCadastro() {
		$valido = true;

		if(strlen($this->__get('nome_colaboradores')) < 3) {
			$valido = false;
		}

		if(strlen($this->__get('senha_colaboradores')) < 3) {
			$valido = false;
		}

		if(strlen($this->__get('funcao_colaboradores')) < 3) {
			$valido = false;
		}


		return $valido;
	}
	/*public function getColaboradoresInicio($palavra) {
		  if($palavra == null){
		$query = "select id_colaboradores,nome_colaboradores, senha_colaborabores,funcao_colaboradores, 
		dataadmissão_colaboradores, situacao_colaboradores  
		from colaboradores";
		  } else{
			$stmt->bindValue(':palavra', $palavra);
			$query = "select 
			id_colaboradores,
			nome_colaboradores, 
			senha_colaborabores,
			funcao_colaboradores, 
			dataadmissão_colaboradores,
			situacao_colaboradores  
		from colaboradores where id_colaboradores =:palavra or nome_colaboradores =:palavra or 
		senha_colaborabores =:palavra or funcao_colaboradores =:palavra or
		dataadmissao_colaboradores =:palavra or situacao_colaboradores =:palavra";
		  }
		$stmt = $this->db->prepare($query);
		
		$stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
	}*/
	public function getColaboradores() {
        $query = "select * from colaboradores";
        $stmt = $this->db->prepare($query);
       
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
	public function getColaboradoresConta() {
		$query = "select count(id_colaboradores) as qnt_colaboradores from colaboradores";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	//recuperar um usuário por e-mail
	public function getUsuarioPorEmail() {
		$query = "select nome_colaboradores,senha_colaboradores, funcao_colaboradores from colaboradores where nome_colaboradores = :nome_colaboradores";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome_colaboradores', $this->__get('nome_colaboradores'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function acesso() {

		$query = "select id_colaboradores,nome_colaboradores,senha_colaboradores, funcao_colaboradores from colaboradores where nome_colaboradores = :nome_colaboradores and senha_colaboradores = :senha_colaboradores";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome_colaboradores', $this->__get('nome_colaboradores'));
		$stmt->bindValue(':senha_colaboradores', $this->__get('senha_colaboradores'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
	

	if( !empty($usuario['id_colaboradores']) &&  !empty($usuario['nome_colaboradores'])  && !empty($usuario['funcao_colaboradores'])) {
			$this->__set('id_colaboradores', $usuario['id_colaboradores']);
			$this->__set('nome_colaboradores', $usuario['nome_colaboradores']);
			$this->__set('funcao_colaboradores', $usuario['funcao_colaboradores']);
		}

		return $this;
	}
	public function DeletarColaboradores() {

		$query = "delete from colaboradores where id_colaboradores=:id_colaboradores";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_colaboradores', $this->__get('id_colaboradores'));
		$stmt->execute();

	   return $this;
   }
}

?>