<?php
	function verifica_materia_duplicada($str_materias,$id_materia){
		$flag=0;
		for($i=0;$i<count($str_materias);$i++)
			if($str_materias[$i]==$id_materia){
				$flag=1;
				break;
			}

		return $flag;
	}

	include_once('bd_pdo.php');
	$id_persona=5;
	$alumno=get_alumno($id_persona);
	$id_cuatrimestre=get_last_cuatrimestre();
	$materias_plan=get_materias_plan($alumno['id_plan'],$id_cuatrimestre);
	$plan=get_plan($alumno['id_plan']);
	$alumno_historial=get_historial($alumno['id']);

	$clases_maestros=get_clases_maestros();

	$seriacion=get_seriaciones();

	$str_cuatrimestre=['Primero','Segundo','Tercero','Cuarto','Quinto','Sexto','Septimo','Octavo','Noveno','Décimo'];
	include_once('v_ver_materias.php');
?>