<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga {

	public $id;
	public $titulo;
	public $descricao;
	public $ativo;
	public $data;

	// MÉTODO RESPONSÁVEL POR CADASTRAR UMA NOVA VAGA NO BANCO
	public function cadastrar(){
		$this->data = date('Y-m-d H:i:s');

		$obDatabase = new Database('vagas');
		// debug
		// echo "<pre>"; print_r($obDatabase); echo "</pre>"; exit;

		// inserir vaga no banco
		$obDatabase = new Database('vagas');
		$this->id = $obDatabase->insert([
						'titulo'    =>$this->titulo,
						'descricao' =>$this->descricao,
						'ativo'     =>$this->ativo,
						'data'      =>$this->data
					]);

		// retorna sucesso
		return true;
	}

	// metodo responsavel por atualizar a vaga no banco
	public function atualizar(){
		return (new Database('vagas'))->update('id = '.$this->id,[
						'titulo'    =>$this->titulo,
						'descricao' =>$this->descricao,
						'ativo'     =>$this->ativo,
						'data'      =>$this->data
					]);
	}

	// metodo responsavel por excluir a vaga do banco
	public function excluir(){
		return (new Database('vagas'))->delete('id= '.$this->id);
	}

	// metodo responsavel por obter as vagas do banco de dados
	public static function getVagas($where = null, $order = null, $limit = null){
    return (new Database('vagas'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

	// metodo responsavel por buscar uma vaga com base em seu ID
  public static function getVaga($id){
    return (new Database('vagas'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }

}