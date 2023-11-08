<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database{


	const HOST = 'localhost';
	const NAME = 'wdev_vagas';
	const USER = 'root';
	const PASS = '';

	private $table;
	private $connection;

	public function __construct($table = null){
		$this->table = $table;
		$this->setConnection();
	}

	private function setConnection(){
		try{
			$this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			die('ERROR: '.$e->getMessage());
		}

	}

	// metodo responsavel por executar queries dentro do banco de dados
	public function execute($query, $params = []){
		try{
			$statement = $this->connection->prepare($query);
			$statement->execute($params);
			return $statement;
		}catch(PDOException $e){
			die('ERROR: '.$e->getMessage());
		}
	}

	public function insert($values){
		// dados da query
		$fields = array_keys($values);
		$binds = array_pad([], count($fields), '?');

		// monta a query
		$query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

		// executa o insert
		$this->execute($query, array_values($values));


		return $this->connection->lastInsertId();
	}

	public function select ($where = null, $order = null, $limit = null){
		// dados da query
		$where = strlen($where) ? 'WHERE '. $where: '';
		$order = strlen($order)? 'ORDER BY '.$order:'';
		$limit = strlen($limit)?'LIMIT '.$limit:'';

		$query = 'SELECT * FROM  ' .$this->table.' '.$where.' '.$order.' '.$limit;

		return $this->execute($query);
	}



	// metodo responsavel por executar a atualizacao no banco de dados

	public function update($where, $values){
		// dados da query
		$fields = array_keys($values);

		// monta a query
		$query = 'UPDATE '.$this->table. ' SET '.implode('=?,',$fields).'=? WHERE '.$where;

		// executar a query
		$this->execute($query, array_values($values));

		return true;

	}

	// metodo responsavel por excluir dados do banco
	public function delete($where){

		$query = 'DELETE FROM '.$this->table.' WHERE '.$where;

		$this->execute($query);

		return true;
	}

}


