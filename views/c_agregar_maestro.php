<?php
	include_once('bd_pdo.php');
	$carreras=get_carreras();#Función definida dentro del archivo bd.php
	/*
	tabla - personas:
		1. id (auto_inc)
		2. curp
		3. nombre
		4. paterno
		5. materno
		6. nss
		7. correo
		8. telefono_movil
		9. telefono_casa
		10. fecha_nac

	tabla - maestros:
		1. id (auto_inc)
		2. numero_empleado
		3. grado_academico
		4. tipo_contrato
		5. id_persona
		6. id_carrera
	*/
	if(isset($_POST['btn_registrar'])){
		$curp=$_POST['curp'];
		$nombre=$_POST['nombre'];
		$paterno=$_POST['paterno'];
		$materno=$_POST['materno'];
		$nss=$_POST['nss'];
		$correo=$_POST['correo'];
		$telefono_movil=$_POST['telefono_movil'];
		$telefono_casa=$_POST['telefono_casa'];
		$fecha_nac=$_POST['fecha_nac'];

		insert_persona($curp,$nombre,$paterno,$materno,$nss,$correo,$telefono_movil,$telefono_casa,$fecha_nac);#Función definida dentro del archivo 

		$numero_empleado=$_POST['numero_empleado'];
		$grado_academico=$_POST['grado_academico'];
		$tipo_contrato=$_POST['tipo_contrato'];

		$personas=get_personas();#Función definida dentro del archivo 

		$id_persona=$personas[count($personas)-1]['id'];
		$id_carrera=$_POST['id_carrera'];
		insert_maestro($numero_empleado,$grado_academico,$tipo_contrato,$id_persona,$id_carrera);#Función definida dentro del archivo 
		
		header("Location:c_ver_maestros.php");
	}
	include_once('v_agregar_maestro.php');
?>