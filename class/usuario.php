<?php

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){

	$sql = new sql();

	$results = $sql->select("SELECT *from tb_usuarios where idusuario = :ID", array(":ID"=>$id));

	if(count($results) > 0 ){

		$this->setData($results[0]);

	};

}

public static function getlist(){

	$sql = new sql();

	return $sql->select("SELECT * FROM TB_USUARIOS ORDER BY DESLOGIN;");

}

public static function search($login){

	$sql = new sql();

	return $sql->select("SELECT * FROM TB_USUARIOS WHERE DESLOGIN LIKE :SEARCH ORDER BY DESLOGIN", array(':SEARCH'=>"%".$login."%"));

}

public function login($login, $senha){

	$sql = new sql();

	$results = $sql->select("SELECT * from tb_usuarios where deslogin = :LOGIN AND dessenha = :SENHA", array(':LOGIN'=>$login,
	':SENHA'=>$senha));

	if(count($results) > 0 ){

		$row = $results[0];

		$this->setData($results[0]);

	}else{

		throw new Exception("Login e/ou senha inválidos");
		

	}

}


public function insert(){

	$sql = new sql();

	$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
		':LOGIN' =>$this->getDeslogin(),
		':PASSWORD'=>$this->getDessenha()

	));

	if (count(results[0]) > 0){

		$this->setData($results[0]);

	}

}

public function update($login, $password){

	$this->setDeslogin($login);
	$this->setDessenha($password);

		$sql = new sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()

		));

}

public function delete(){

	$sql = new sql();

	$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", arrya(
		':ID'=>$this->getIdusuario()

	));

	$this->setIdusuario(0);
	$this->setDeslogin("");
	$this->setDessenha("");
	$this->setDtcadastro(new DateTime());

}

public function __constructor($login='', $password=''){

		$this->setDeslogin($login);
		$this->setDessenha($password);

}

public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));

}

public function __toString(){

	return json_encode(array(
		"idusuarios"=>$this->getIdusuario(),
		"deslogin"=>$this->getDeslogin(),
		"dessenha"=>$this->getDessenha(),
		"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:m:s")
	));
}



}

?>