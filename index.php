<?php

require_once("config.php");

/*$sql = new sql();

$usuarios = $sql->select("SELECT * from TB_USUARIOS;");

echo json_encode($usuarios);*/

//carrega um usuário:
//$root = new usuario();
//$root->loadById(24);
//echo $root;

//carrega umalistas de usuários:

//$lista = Usuario::getlist();
//echo json_encode($lista);

//CARREGA UMA LISTA DE USUÁRIO BUSCANDO PELO LOGIN

//$search = Usuario::search("a");
//echo json_encode($search);

//carrega o usuário usando o lçogin e a senha;

$usuario = new Usuario();
$usuario->login("gilmar", "56984");

echo $usuario;

?>