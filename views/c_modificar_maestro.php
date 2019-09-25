<?php
	require_once('bd_pdo.php');
	if(isset($_REQUEST['id'])) $id_persona=$_REQUEST['id'];
	if(isset($_POST['btn_guardar'])){
		$id_persona=$_POST['id_persona'];
		$curp=$_POST['curp'];
		$nombre=$_POST['nombre'];
		$paterno=$_POST['paterno'];
		$materno=$_POST['materno'];
		$nss=$_POST['nss'];
		$correo=$_POST['correo'];
		$telefono_movil=$_POST['telefono_movil'];
		$telefono_casa=$_POST['telefono_casa'];
		$fecha_nac=$_POST['fecha_nac'];

		update_persona($id_persona,$curp,$nombre,$paterno,$materno,$nss,$correo,$telefono_movil,$telefono_casa,$fecha_nac);#Función definida dentro del archivo 

		$id_persona=$_POST['id_persona'];
		$numero_empleado=$_POST['numero_empleado'];
		$grado_academico=$_POST['grado_academico'];
		$tipo_contrato=$_POST['tipo_contrato'];

		$id_carrera=$_POST['id_carrera'];
		update_maestro($id_persona,$numero_empleado,$grado_academico,$tipo_contrato,$id_carrera);#Función definida dentro del archivo 
		header('Location:c_ver_maestros.php');
	}else{
		$datos=get_maestro_by_id($id_persona);#bd.php
		$carreras=get_carreras();#bd.php
		include_once('v_modificar_maestro.php');
	}
	if(!isset($_REQUEST['id']))
		header('Location:c_ver_maestros.php');
?>