<?php
	require_once('bd_pdo.php');
	$maestros=get_maestros();#Función definida dentro del archivo 'bd.php'
	$respaldo_maestros=$maestros;
	$json_array=json_encode($respaldo_maestros);
	include_once('v_ver_maestros.php');
?>