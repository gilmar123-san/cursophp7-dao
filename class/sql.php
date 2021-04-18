<?php

class sql extends PDO {

	private $conexao;

	public function __construct(){

		$this->conexao = new PDO("mysql:host=localhost; dbname=bdphp7", "root", "" );

	}

	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->setParam($statment, $key, $value);

		}

	}


	private function setParam($statment, $key, $value){

		$statment->db2_bind_param(stmt, parameter-number, variable-name)am ($key, $value);

	}

	public function query($rowQuery, $params = array()){

		$stmt = $this->conexao->prepare($rowQuery);

			$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt;

		}


		public function select($rowQuery, $params = array()):array {

			$stmt = $this->query($rowQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

}

?>