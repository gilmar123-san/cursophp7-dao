<?php

require_once("config.php");

$sql = new sql();

$usuarios = $sql->select("SELECT * from TB_USUARIOS;");

echo json_encode($usuarios);


?>