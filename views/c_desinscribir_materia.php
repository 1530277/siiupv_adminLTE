<?php
	require_once('bd_pdo.php');
	if(isset($_POST)){
		$id_clase=$_REQUEST['id_clase'];
		$id_materia=$_REQUEST['id_materia'];
		$id_alumno=$_REQUEST['id_alumno'];
		$id_carrera=$_REQUEST['id_carrera'];
		$id_plan=$_REQUEST['id_plan'];
		$id_cuatrimestre=$_REQUEST['id_cuatrimestre'];
		$calificacion=200;
		$oportunidad=1;
		
		$capacidad=get_capacidad_clase($id_clase);
		$capacidad=intval($capacidad);
		$capacidad++;
		delete_historial($id_alumno,$id_materia,$id_cuatrimestre);
		update_clase($id_clase,$capacidad);//Incrementa la capacidad de la clase
		header('Location:c_ver_materias.php');
	}
?>