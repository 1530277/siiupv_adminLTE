<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Reinscripción</title>
	<?php include_once('include_css.php');?>
</head>
<body class="hold-transition skin-purple sidebar-mini fixed">
	<div class="wrapper">
		<?php require_once('header.php');?>
		<?php require_once('left-bar.php');?>


		 <!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			  <h1>
			    Elegir materias
			    <small>Elige tus materias</small>
			  </h1>
			  <ol class="breadcrumb">
			    <li><a href="#"><i class="fa fa-dashboard"></i>Alumno: <?php echo $alumno['matricula']; ?></a></li>
			    <li class="active">Alta de materias</li>
			  </ol>
			</section>

			<!-- Main content -->
			<section class="content container-fluid">
          <!-- general form elements -->
					        <!-- DATOS TABLA !-->
			    <?php $str_materias=[];$str_count=0; for($n=0;$n<$plan['numero_cuatrimestres'];$n++){?>
			        <div class="callout callout-info" style="overflow: auto;background-color: #d2d6de!important;border-color: purple!important;">
			        	<?php 
			        		#foreach ($materias_plan as $materia) {
			        		#	print_r($materia);echo "<br><br>";
			        		#}
			        	?>
			        	<div>
			        		<h3 style="color:black;"><?php echo $str_cuatrimestre[$n]; ?> </h3>
			        	</div>
			        	<div class="row">
			        		<?php for($i=0;$i<count($materias_plan);$i++){ 
			        			if($n+1==$materias_plan[$i]['cuatrimestre']){
									if(!verifica_materia_duplicada($str_materias,$materias_plan[$i]['id_materia'])){
										$str_materias[$str_count]=$materias_plan[$i]['id_materia'];$str_count++;?>

						        		<div class="col-md-4 col-sm-6 col-xs-12">
								          <div class="info-box" style="height: 100px!important;">
								          	<?php $flag=0; if($flag==0&&is_red_green($alumno['id'],$materias_plan[$i])==1){#Valida si está reprobada y tiene que recursar ?>
									            <span class="info-box-icon bg-red" style="height: 100px!important;" id="<?php echo $materias_plan[$i]['id_materia']; ?>"><i class="fa fa-fw fa-frown-o"></i></span>
								        	<?php $flag=1;}if($flag==0&&is_red_green($alumno['id'],$materias_plan[$i])==3&&has_seriacion($materias_plan[$i])){#Valida si no la puede tomar?>
								            	<span class="info-box-icon bg-light-blue" style="height: 100px!important;" id="<?php echo $materias_plan[$i]['id_materia']; ?>"><i class="fa fa-fw fa-lock"></i></span>
								        	<?php $flag=2;}if($flag==0&&is_red_green($alumno['id'],$materias_plan[$i])==2){#Valida si ya está pasada la materia?>
									            <span class="info-box-icon bg-green" style="height: 100px!important;" id="<?php echo $materias_plan[$i]['id_materia']; ?>"><i class="fa fa-fw fa-graduation-cap"></i></span>
								        	<?php $flag=3;}if($flag==0){#Valida si puede que tomar la materia?>
									            <span class="info-box-icon bg-yellow" style="height: 100px!important;" id="<?php echo $materias_plan[$i]['id_materia']; ?>"><i class="fa fa-fw fa-unlock"></i></span>
								        	<?php $flag=4;}?>
								            
								            <div class="info-box-content" style="color:black;height: 70%!important;">
								              <span class="i">Materia: <?php echo $materias_plan[$i]['nombre_materia']; ?></span>
								              <span class="info-box-number" id="<?php echo 'span_'.$materias_plan[$i]['id_materia']; ?>">Créditos: <?php echo $materias_plan[$i]['creditos']; ?></span>
							            	</div>
							              <button class="btn btn-box-tool" data-toggle="modal" data-target="#modal-seriacion"  onclick="seriacion('<?php echo $materias_plan[$i]["id_materia"]; ?>')"><i class="fa fa-fw fa-external-link-square"></i>Requiere</button>
							              <?php if($flag==1||$flag==4||is_red_green($alumno['id'],$materias_plan[$i])==4){ ?>
							              	<button class="btn btn-box-tool" data-toggle="modal" data-target="#modal-clases" onclick="Inscribirse('<?php echo $materias_plan[$i]["id_materia"]; ?>')"><i class="fa fa-fw fa-navicon"></i>Inscribirse</button>
							          	  <?php }?>
								            <!-- /.info-box-content -->
								          </div>
								          <!-- /.info-box -->
								        </div>
						        <!-- /.col -->
					    	<?php }}} ?>
			        	</div>
			        </div>
			    <?php } ?>
			    			<!-- modal seriacion -->
		    		<div class="modal modal-info fade" id="modal-seriacion">
			          <div class="modal-dialog">
			            <div class="modal-content">
			              <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">&times;</span></button>
			                <h4 class="modal-title">Verifica seriación de materia.</h4>
			              </div>
			              <div class="modal-body">
			                <div class="box-body no-padding">
				              	
				              	<div id="callout_seriacion" class="callout callout-info" style="display: none;">
					          		<h3>Materia sin seriación.</h3>
					          		<p>Para tomar esta materia no se requiere haber acreditado alguna otra con anterioridad. Para más información consulta con un maestro, tutor o director de carrera.</p>
				          		</div>
				          		
				          		<table id="tabla_seriacion" class="table table-condensed">
					                <thead>
					                	<tr>
					                		<th colspan="2" style="text-align: center;">Se requiere tomar antes.</th>
					                	</tr>
					                	<tr>
					                		<th>#</th>
						                	<th>Materia</th>
						                </tr>
					            	</thead>
					            	<tbody></tbody>
				              	</table>
				            </div>
				            <!-- /.box-body -->
			              </div>
			              <div class="modal-footer">
			                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Entendido</button>
			              </div>
			            </div>
			            <!-- /.modal-content -->
			          </div>
			          <!-- /.modal-dialog -->
			        </div>
					        <!-- /.modal -->

					        <!-- modal clases-->
		    		<div class="modal modal-info fade" id="modal-clases">
			          <div class="modal-dialog">
			            <div class="modal-content">
			              <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">&times;</span></button>
			                <h4 class="modal-title">Información completa</h4>
			              </div>
			              <div class="modal-body">
			                <div class="box-body no-padding">
				              	
				              	<div id="callout_clases" class="callout callout-info" style="display: none;">
					          		<h3>Materia sin seriación.</h3>
					          		<p>Para tomar esta materia no se requiere haber acréditado alguna otra. Para más información consulta con un maestro, tutor o director de carrera.</p>
				          		</div>
				          		
				          		<table id="tabla_clases" class="table table-condensed">
					                <thead>
					                	<tr>
					                		<th>#</th>
						                	<th>Clase</th>
						                	<th>Maestro</th>
						                	<th></th>
						                </tr>
					            	</thead>
					            	<tbody></tbody>
				              	</table>
				            </div>
				            <!-- /.box-body -->
			              </div>
			              <div class="modal-footer">
			                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
			              </div>
			            </div>
			            <!-- /.modal-content -->
			          </div>
			          <!-- /.modal-dialog -->
			        </div>
					        <!-- /.modal -->
          	
          	</section>
        </div>
    </div>
</body>
</html>
<?php include_once('include_js.php'); ?>

<script>
	function Inscribirse(id_materia){
		var clases_maestros=JSON.parse('<?php echo json_encode($clases_maestros); ?>');
		var alumno_historial=JSON.parse('<?php echo json_encode($alumno_historial); ?>');
		var materias_plan=JSON.parse('<?php echo json_encode($materias_plan); ?>');
		var alumno=JSON.parse('<?php echo json_encode($alumno); ?>');
		var flag_oportunidades='<?php echo $flag; ?>';

		var mi_tabla=document.getElementById('tabla_clases')


		while (mi_tabla.firstChild) {//Elimina elementos dentro de la tabla cada vez que se llama la funcion, dado que todos los botones se dirigen al mismo modal pero se cargan con distintos datos
			mi_tabla.removeChild(mi_tabla.firstChild);
		}


		var tblBody = document.createElement("tbody");
		var thead=document.createElement('thead');
		var flag=0,f_index=0;

		var id_alumno=alumno.id;
		var id_cuatrimestre='<?php echo $id_cuatrimestre; ?>';
		var id_plan=alumno.id_plan;//
		var id_carrera=alumno.id_carrera;

		for(var i=0;i<alumno_historial.length;i++)
			if(id_materia==alumno_historial[i].id_materia){
				flag=1;
				f_index=i;
				break;
			}

	    fila = document.createElement("tr");
	    
	    columna = document.createElement("th");
	   	contenidoColumna = document.createTextNode("#");
	    columna.appendChild(contenidoColumna);
	    fila.appendChild(columna);
	    
	    columna = document.createElement("th");
	    contenidoColumna = document.createTextNode("Clase");
	    columna.appendChild(contenidoColumna);
	    fila.appendChild(columna);
	    
	    columna = document.createElement("th");
	    contenidoColumna = document.createTextNode("Maestro");
	    columna.appendChild(contenidoColumna);
		fila.appendChild(columna);

	    columna = document.createElement("th");
	    contenidoColumna = document.createTextNode("Acción");
	    columna.appendChild(contenidoColumna);
		fila.appendChild(columna);

		thead.appendChild(fila);

		for(var i=0,j=0;i<clases_maestros.length;i++){
			if(clases_maestros[i].id_materia==id_materia){
				j++;			    
			    fila = document.createElement("tr");
			    
			    columna = document.createElement("td");
			    contenidoColumna = document.createTextNode(j);
			    columna.appendChild(contenidoColumna);
			    fila.appendChild(columna);
			    
			    columna = document.createElement("td");
			    contenidoColumna = document.createTextNode(clases_maestros[i].clave_clase);
			    columna.appendChild(contenidoColumna);
			    fila.appendChild(columna);

			    columna = document.createElement("td");
			    contenidoColumna = document.createTextNode(clases_maestros[i].nombre+" "+clases_maestros[i].paterno+" "+clases_maestros[i].materno);
			    columna.appendChild(contenidoColumna);
			    fila.appendChild(columna);

			    columna = document.createElement("td");

			    var form=document.createElement('form');
			    form.setAttribute('method','post');

			    //id_materia,id_alumno,id_clase
			    //id_carrera,id_plan,id_cuatrimestre,calificacion,oportunidad

			    //1. primero agregar ó eliminar registro de historial donde id_materia,id_alumno coincidan
			    //2. afectar columna capacidad en tabla clases donde id_clase coincida
			    str_enviar='id_materia='+id_materia
						+'&id_clase='+clases_maestros[i].id_clase
						+'&id_alumno='+id_alumno
						+'&id_plan='+id_plan
						+'&id_cuatrimestre='+id_cuatrimestre
						+'&id_carrera='+id_carrera
						+'&flag='+flag_oportunidades;
			    var button = document.createElement('button');
			    if(flag==0||parseFloat(alumno_historial[f_index].calificacion)<70.0){
				    button.innerHTML='<i class="fa fa-fw fa-plus"></i>Inscribirme';
			    	button.setAttribute('class','btn btn-box-tool bg-green');
					form.setAttribute('action','c_inscribir_materia.php?'+str_enviar);
			    }
			    else{
				    button.innerHTML='<i class="fa fa-fw fa-remove"></i>Deshacer';
			    	button.setAttribute('class','btn btn-box-tool bg-red');
					form.setAttribute('action','c_desinscribir_materia.php?'+str_enviar);
			    }

				form.appendChild(button);
			    columna.appendChild(form);
			    fila.appendChild(columna);

			    tblBody.appendChild(fila);
			}
		}
		mi_tabla.appendChild(thead);
		mi_tabla.appendChild(tblBody);
  	}

	function seriacion(id_materia){//It's okay
		var count_seriadas=0;
		var seriacion=JSON.parse('<?php echo json_encode($seriacion); ?>');
		
		for(var i=0;i<seriacion.length;i++){
			if(seriacion[i].id_materia==id_materia)
				count_seriadas++;
		}

		if(count_seriadas>0){
		  	var mi_tabla = document.getElementById("tabla_seriacion");
		  	while (mi_tabla.firstChild) {
				  mi_tabla.removeChild(mi_tabla.firstChild);
			}
		    var tblBody = document.createElement("tbody");
		    var thead=document.createElement('thead');

		    fila = document.createElement("tr");
		    
		    columna = document.createElement("th");
		   	contenidoColumna = document.createTextNode("#");
		    columna.appendChild(contenidoColumna);
		    fila.appendChild(columna);
		    
		    columna = document.createElement("th");
		    contenidoColumna = document.createTextNode("Materia");
		    columna.appendChild(contenidoColumna);
		    fila.appendChild(columna);

			thead.appendChild(fila);

			for(var i=0,j=0;i<seriacion.length;i++){
				if(seriacion[i].id_materia==id_materia){
					j++;
			    fila = document.createElement("tr");
			    columna = document.createElement("td");
			    contenidoColumna = document.createTextNode(j);
			    columna.appendChild(contenidoColumna);
			    fila.appendChild(columna);
			    
			    columna = document.createElement("td");
			    contenidoColumna = document.createTextNode(seriacion[i].nombre_requerido);
			    columna.appendChild(contenidoColumna);

			    fila.appendChild(columna);
			    tblBody.appendChild(fila);
			}
		}
		mi_tabla.appendChild(thead);
	    mi_tabla.appendChild(tblBody);

			document.getElementById('callout_seriacion').style.display='none';
			document.getElementById('tabla_seriacion').style.display='';
		}else{
			document.getElementById('callout_seriacion').style.display='block';
			document.getElementById('tabla_seriacion').style.display='none';
		}
	}
</script>