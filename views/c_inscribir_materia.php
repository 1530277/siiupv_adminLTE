<?php
	require_once('bd_pdo.php');
	if((isset($_POST))){
		$id_clase=$_GET['id_clase'];
		$id_materia=$_GET['id_materia'];
		$id_alumno=$_GET['id_alumno'];
		$id_carrera=$_GET['id_carrera'];
		$id_plan=$_GET['id_plan'];
		$id_cuatrimestre=$_GET['id_cuatrimestre'];
		$flag_oportunidades=$_GET['flag_oportunidades'];
		$calificacion=200.00;
		#Se valida que oportunidad es
		if($flag_oportunidades=='1')//Si la bandera está en uno significa que antes ya ha tomado la materia pero la reprobó
			$oportunidad=get_oportunidad($id_materia,$id_alumno);
		else
			$oportunidad=1;
		
		$capacidad=get_capacidad_clase($id_clase);
		$capacidad=intval($capacidad);
		$capacidad--;
		if($capacidad>=0){
			insert_historial($id_alumno,$id_carrera,$id_plan,$id_materia,$id_cuatrimestre,$calificacion,$oportunidad);
			update_clase($id_clase,$capacidad);//Decrementa la capacidad de la clase
		}
		header('Location:c_ver_materias.php');
	}
?>