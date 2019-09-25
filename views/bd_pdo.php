<?php
	$usuario="root";
	$password="";
	$servidor = "localhost";
	$bd = "siiupv";
	try{
		$mbd = new PDO("mysql:host={$servidor};dbname={$bd}",$usuario,$password);
		$mbd-> exec("set names utf8");
	}catch(PDOException $e){
		echo "Error-PDO: ".$e->getMessage()."<br>";
		die();
	}

	function get_carrera_by_sigla($siglas){
		global $mbd;
		$query=$mbd->prepare('SELECT id from carreras where :siglas=siglas');
		$query->bindParam(':siglas',$siglas,PDO::PARAM_STR);
		$query->execute();
		$id_carrera=$query->fetch();
		return $id_carrera;
	}

	function get_carreras(){
		global $mbd;
		$query=$mbd->prepare('SELECT * FROM carreras');
		$query->execute();
		$carreras=$query->fetchAll();			
		return $carreras;
	}
	#---------------------------------------------- Persona -----------------------------------------------#
	function insert_persona($curp,$nombre,$paterno,$materno,$nss,$correo,$telefono_movil,$telefono_casa,$fecha_nac){
		
		global $mbd;
		try{
			$query=$mbd->prepare('INSERT INTO personas(curp,nombre,paterno,materno,nss,correo,telefono_movil,telefono_casa,fecha_nac) values(:curp,:nombre,:paterno,:materno,:nss,:correo,:telefono_movil,:telefono_casa,:fecha_nac)');
			
			$query->bindParam(':curp',$curp,PDO::PARAM_STR);
			$query->bindParam(':nombre',$nombre,PDO::PARAM_STR);
			$query->bindParam(':paterno',$paterno,PDO::PARAM_STR);
			$query->bindParam(':materno',$materno,PDO::PARAM_STR);
			$query->bindParam(':nss',$nss,PDO::PARAM_STR);
			$query->bindParam(':correo',$correo,PDO::PARAM_STR);
			$query->bindParam(':telefono_movil',$telefono_movil,PDO::PARAM_STR);
			$query->bindParam(':telefono_casa',$telefono_casa,PDO::PARAM_STR);
			$query->bindParam(':fecha_nac',$fecha_nac,PDO::PARAM_STR);
			$query->execute();
		}catch(PDOException $e){
			echo "<br><br>Error-DATABASE: ".$e->getMessage()."<br><br>";
		}
	}

	function update_persona($id_persona,$curp,$nombre,$paterno,$materno,$nss,$correo,$telefono_movil,$telefono_casa,$fecha_nac){
		global $mbd;

		try{
			$query=$mbd->prepare('
				UPDATE personas SET
					curp=:curp,
					nombre=:nombre,
					paterno=:paterno,
					materno=:materno,
					nss=:nss,
					correo=:correo,
					telefono_movil=:telefono_movil,
					telefono_casa=:telefono_casa,
					fecha_nac=:fecha_nac
				where id=:id_persona
				');
			$query->bindParam(':curp',$curp,PDO::PARAM_STR);
			$query->bindParam(':nombre',$nombre,PDO::PARAM_STR);
			$query->bindParam(':paterno',$paterno,PDO::PARAM_STR);
			$query->bindParam(':materno',$materno,PDO::PARAM_STR);
			$query->bindParam(':nss',$nss,PDO::PARAM_STR);
			$query->bindParam(':correo',$correo,PDO::PARAM_STR);
			$query->bindParam(':telefono_movil',$telefono_movil,PDO::PARAM_STR);
			$query->bindParam(':telefono_casa',$telefono_casa,PDO::PARAM_STR);
			$query->bindParam(':fecha_nac',$fecha_nac,PDO::PARAM_STR);
			$query->bindParam(':id_persona',$id_persona,PDO::PARAM_STR);
			$query->execute();
		}catch(PDOException $e){
			echo "<br><br>Error-DATABASE: ".$e->getMessage()."<br><br>";
		}
	}
	function get_personas(){
		global $mbd;

		$query=$mbd->prepare('SELECT * FROM personas');
		$query->execute();
		$personas=$query->fetchAll();
		return $personas;
	}

	function get_maestros(){
		global $mbd;

		$query=$mbd->prepare('SELECT 
			p.id as "id_persona",
			m.id as "id_maestro",
			c.nombre as "nombre_carrera",
			p.curp,
			p.nombre,
			p.paterno,
			p.materno,
			p.nss,
			p.correo,
			p.telefono_casa,
			p.telefono_movil,
			p.fecha_nac,
			m.numero_empleado,
			m.grado_academico,
			m.tipo_contrato 
		FROM `personas` p INNER JOIN `maestros` m 
		ON p.id=m.id_persona 
		INNER JOIN `carreras` c ON c.id=m.id_carrera');


		$query->execute();
		$datos=$query->fetchAll();
		return $datos;
	}
	#------------------------------------------------------------------------------------------------------#
	#------------------------------------------------- Maestro --------------------------------------------#
	function insert_maestro($numero_empleado,$grado_academico,$tipo_contrato,$id_persona,$id_carrera){
		try{
			global $mbd;

			$query=$mbd->prepare('INSERT INTO maestros(numero_empleado,grado_academico,tipo_contrato,id_persona,id_carrera) values(:numero_empleado,:grado_academico,:tipo_contrato,:id_persona,:id_carrera)');
			$query->bindParam(':numero_empleado',$numero_empleado,PDO::PARAM_STR);
			$query->bindParam(':grado_academico',$grado_academico,PDO::PARAM_STR);
			$query->bindParam(':tipo_contrato',$tipo_contrato,PDO::PARAM_STR);
			$query->bindParam(':id_persona',$id_persona,PDO::PARAM_STR);
			$query->bindParam(':id_carrera',$id_carrera,PDO::PARAM_STR);
			$query->execute();
		}catch(PDOException $e){
			echo "<br><br>Error-DATABASE: ".$e->getMessage()."<br><br>";
		}
	}

	function update_maestro($id_persona,$numero_empleado,$grado_academico,$tipo_contrato,$id_carrera){
		global $mbd;
		try{
			$query=$mbd->prepare('
				UPDATE maestros SET
					numero_empleado=:numero_empleado,
					grado_academico=:grado_academico,
					tipo_contrato=:tipo_contrato,
					id_carrera=:id_carrera
				WHERE id_persona=:id_persona
				');
			$query->bindParam(':numero_empleado',$numero_empleado,PDO::PARAM_STR);
			$query->bindParam(':grado_academico',$grado_academico,PDO::PARAM_STR);
			$query->bindParam(':tipo_contrato',$tipo_contrato,PDO::PARAM_STR);
			$query->bindParam(':id_carrera',$id_carrera,PDO::PARAM_STR);
			$query->bindParam(':id_persona',$id_persona,PDO::PARAM_STR);
			$query->execute();
		}catch(PDOException $e){
			echo "<br><br>Error-DATABASE: ".$e->getMessage()."<br><br>";
		}
	}

	
	function get_maestro_by_id($id_persona){
		global $mbd;

		$query=$mbd->prepare('SELECT 
			p.id as "id_persona",
			m.id as "id_maestro",
			p.curp,
			p.nombre,
			p.paterno,
			p.materno,
			p.nss,
			p.correo,
			p.telefono_casa,
			p.telefono_movil,
			p.fecha_nac,
			m.numero_empleado,
			m.grado_academico,
			m.tipo_contrato,
			m.id_carrera
		FROM `personas` p 
		inner JOIN `maestros` m 
		ON p.id=m.id_persona 
		WHERE p.id=:id_persona');
		$query->bindParam(':id_persona',$id_persona,PDO::PARAM_STR);
		$query->execute();
		$consulta=$query->fetch();
		return $consulta;
	}

	function drop_maestro($id_persona){
		try{	
			global $mbd;
			$query=$mbd->prepare('DELETE FROM maestros WHERE id_persona=:id_persona');
			$query->bindParam(':id_persona',$id_persona,PDO::PARAM_STR);
			$query->execute();
			
			$query=$mbd->prepare('DELETE FROM personas WHERE id=:id_persona');
			$query->bindParam(':id_persona',$id_persona,PDO::PARAM_STR);
			$query->execute();
		}catch(PDOException $e){
			echo "<br><br>Error-DATABASE: ".$e->getMessage()."<br><br>";
		}
	}
	#-----------------------------------------------------------------------------------------------------#
	#--------------------------------------------------- Alumno ------------------------------------------#
	function get_alumno($id_persona){
		global $mbd;
		$query=$mbd->prepare('SELECT * FROM alumnos WHERE id_persona=:id_persona');
		$query->bindParam(':id_persona',$id_persona,PDO::PARAM_STR);
		$query->execute();
		$datos=$query->fetch();
		return $datos;
	}
	function get_materias_plan($id_plan,$id_cuatrimestre){
		global $mbd;
		$query=$mbd->prepare('SELECT 
				p.id as id_plan,
				p.clave,
				p.fecha_inicio,
				p.fecha_termino,
				p.activo,
				p.numero_cuatrimestres,
				p.id_carrera,
				pm.id_materia,
				pm.cuatrimestre,
				pm.creditos,
				pm.horas_practica,
				pm.horas_teoricas,
				m.nombre as nombre_materia,
				m.nombre_corto,
				c.clave as "clave_clase"
			FROM `planes_estudio` p 
			INNER JOIN `planes_con_materias` pm
			ON p.id=pm.id_plan
			INNER JOIN `materias` m
			ON m.id=pm.id_materia
			INNER JOIN `clases` c
			ON c.id_materia=pm.id_materia
			INNER JOIN `grupos` g
			ON g.id=c.id_grupo
		WHERE p.id=:id_plan AND g.id_cuatrimestre=:id_cuatrimestre
		ORDER BY m.nombre ASC');

		$query->bindParam(':id_plan',$id_plan,PDO::PARAM_STR);
		$query->bindParam(':id_cuatrimestre',$id_cuatrimestre,PDO::PARAM_STR);
		$query->execute();
		$datos=$query->fetchAll();
		return $datos;
	}
	function get_plan($id_plan){
		global $mbd;
		$query=$mbd->prepare('SELECT * FROM planes_estudio WHERE id=:id_plan');
		$query->bindParam(':id_plan',$id_plan,PDO::PARAM_STR);
		$query->execute();
		$datos=$query->fetch();
		return $datos;
	}
	#-----------------------------------------------------------------------------------------------------#
	function get_historial($id_alumno){
		global $mbd;
		$query=$mbd->prepare('SELECT 
				h.id_alumno,
				h.id_carrera,
				h.id_plan,
				h.id_materia,
				m.nombre as "nombre_materia",
				m.nombre_corto,
				h.id_cuatrimestre,
				h.calificacion,
				h.oportunidad,
				c.descripcion
			FROM historial h 
			INNER JOIN materias m
			ON m.id=h.id_materia
			INNER JOIN cuatrimestres c
			ON c.id=h.id_cuatrimestre
		WHERE id_alumno=:id_alumno
		ORDER BY m.nombre');
		$query->bindParam(':id_alumno',$id_alumno,PDO::PARAM_STR);
		$query->execute();
		$datos=$query->fetchAll();
		return $datos;
	}
	function get_last_cuatrimestre(){
		global $mbd;
		$query=$mbd->prepare('SELECT id FROM cuatrimestres');
		$query->execute();
		$datos=$query->fetchAll();
		return $datos[count($datos)-1]['id'];#Retorna el id del último registro en la tabla
	}
	function has_seriacion($materia){
		global $mbd;
		$query=$mbd->prepare('SELECT * FROM seriacion WHERE id_materia=:id_materia');
		$query->bindParam(':id_materia',$materia['id_materia'],PDO::PARAM_STR);
		$query->execute();
		$datos=$query->fetchAll();
		if(!empty($datos))
			return 1;
		else
			return 0;
	}
	function is_red_green($id_alumno,$materia){
		global $mbd;
		$query=$mbd->prepare('SELECT * FROM historial h
			INNER JOIN `alumnos` a
			ON a.id=h.id_alumno
		WHERE id_materia=:id_materia AND id_alumno=:id_alumno');
		$query->bindParam(':id_materia',$materia['id_materia'],PDO::PARAM_STR);
		$query->bindParam(':id_alumno',$id_alumno,PDO::PARAM_STR);
		$query->execute();
		$datos=$query->fetch();
		if(!empty($datos)){
			if(floatval($datos['calificacion'])==200.00)
				return 4;
			if(floatval($datos['calificacion'])<70.0)
				return 1;
			else
				return 2;
		}
		else
			return 3;
	}
	function get_clases_maestros(){
		global $mbd;

		$query=$mbd->prepare('SELECT 
				c.id as id_clase,
				c.clave as clave_clase,
				c.id_grupo,
				c.id_carrera,
				c.id_plan,
				c.id_materia,
				c.id_maestro,
				p.nombre,
				p.paterno,
				p.materno
			FROM clases c
			INNER JOIN maestros m
			ON m.id=c.id_maestro
			INNER JOIN personas p
			ON p.id=m.id_persona
		');
		$query->execute();
		$datos=$query->fetchAll();
		return $datos;
	}

	function get_seriaciones(){
		global $mbd;

		$query=$mbd->prepare('SELECT
				s.id_materia,
				s.id_materia_requerida,
				m1.nombre,
				m2.nombre as nombre_requerido,
				m1.nombre_corto,
				m2.nombre_corto as corto_requerido
			FROM seriacion s
			INNER JOIN materias m1
			ON s.id_materia=m1.id
			INNER JOIN materias m2
			ON s.id_materia_requerida=m2.id
		');
		$query->execute();
		$datos=$query->fetchAll();
		return $datos;
	}

	function get_clase($id_clase){
		global $mbd;

		$query=$mbd->prepare('SELECT * FROM clases WHERE id=:id_clase');
		$query->bindParam(':id_clase',$id_clase,PDO::PARAM_STR);
		$query->execute();

		$datos=$query->fetch();
		return $datos;
	}

	function update_clase($id_clase,$capacidad){//Capacidad del curso
		global $mbd;

		$query=$mbd->prepare('UPDATE clases SET
				capacidad=:capacidad
			WHERE id=:id_clase
		');
		$query->bindParam(':capacidad',$capacidad,PDO::PARAM_STR);
		$query->bindParam(':id_clase',$id_clase,PDO::PARAM_STR);
		$query->execute();
	}

	function get_capacidad_clase($id_clase){
		global $mbd;

		$query=$mbd->prepare('SELECT * FROM clases WHERE id=:id_clase');
		$query->bindParam(':id_clase',$id_clase,PDO::PARAM_STR);
		$query->execute();
		$datos=$query->fetch();
		return $datos['capacidad'];
	}

	function delete_historial($id_alumno,$id_materia,$id_cuatrimestre){
		global $mbd;

		$query=$mbd->prepare('DELETE FROM historial WHERE id_alumno=:id_alumno and id_materia=:id_materia');
		$query->bindParam(':id_alumno',$id_alumno,PDO::PARAM_STR);
		$query->bindParam(':id_materia',$id_materia,PDO::PARAM_STR);
		$query->execute();
	}

	function get_oportunidad($id_materia,$id_alumno){
		global $mbd;
		
		$query=$mbd->prepare('SELECT * FROM historial WHERE id_materia=:id_materia and id_alumno=:id_alumno and id_cuatrimestre=:id_cuatrimestre');
		$query->bindParam(':id_alumno',$id_clase,PDO::PARAM_STR);
		$query->bindParam(':id_materia',$id_materia,PDO::PARAM_STR);
		$query->bindParam(':id_cuatrimestre',$id_cuatrimestre,PDO::PARAM_STR);
		$query->execute();
		$datos=$query->fetch();
		return $datos['oportunidad'];
	}

	function insert_historial($id_alumno,$id_carrera,$id_plan,$id_materia,$id_cuatrimestre,$calificacion,$oportunidad){
		//id_alumno,id_carrera,id_plan,id_materia,id_cuatrimestre,calificacion,oportunidad
		global $mbd;
		try{
			$query=$mbd->prepare('INSERT INTO 
				historial(id_alumno,id_carrera,id_plan,id_materia,id_cuatrimestre,calificacion,oportunidad)
				VALUES(:id_alumno,:id_carrera,:id_plan,:id_materia,:id_cuatrimestre,:calificacion,:oportunidad)');
			$query->bindParam(':id_alumno',$id_alumno,PDO::PARAM_STR);
			$query->bindParam(':id_carrera',$id_carrera,PDO::PARAM_STR);
			$query->bindParam(':id_plan',$id_plan,PDO::PARAM_STR);
			$query->bindParam(':id_materia',$id_materia,PDO::PARAM_STR);
			$query->bindParam(':id_cuatrimestre',$id_cuatrimestre,PDO::PARAM_STR);
			$query->bindParam(':calificacion',$calificacion,PDO::PARAM_STR);
			$query->bindParam(':oportunidad',$oportunidad,PDO::PARAM_STR);
			$query->execute();
		}catch(PDOException $e){
			echo "<br><br>Error-DATABASE: ".$e->getMessage()."<br><br>";
		}
	}
?>