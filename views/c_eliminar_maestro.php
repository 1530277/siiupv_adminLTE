<?php
	require_once('bd_pdo.php');
	if(isset($_REQUEST['id'])) $id_persona=$_REQUEST['id'];
	else header('Location:c_ver_maestros.php');
	drop_maestro($id_persona);
	header('Location: c_ver_maestros.php');
?>