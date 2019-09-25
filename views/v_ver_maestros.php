<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Maestros</title>
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
			    Maestros
			    <small>Vista de los registro</small>
			  </h1>
			  <ol class="breadcrumb">
			    <li><a href="#"><i class="fa fa-dashboard"></i> Maestros</a></li>
			    <li class="active">Nuevo</li>
			  </ol>
			</section>

			<!-- Main content -->
			<section class="content container-fluid">
          <!-- general form elements -->
          		<div role="form" class="invoice" style="background-color:#ecf0f5; border-color:#ecf0f5;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="div_ejemplo">
          
					        <!-- DATOS TABLA !-->
					        <div class="box box-primary">
				           				
							        	<!-- /.box-header -->
				            <div class="box-body">
				            	<?php if(count($maestros)!=0){ ?>
	                            <table id="mostrar_maestros" class="table table-bordered table-striped">
					                <thead>
						                <tr>
						                  <th style="width: 10px;">#</th>
						                  <th>Número de empleado</th>
						                  <th>Nombre</th>
						                  <th>Carrera</th>
						                  <th>Grado académico</th>
						                  <th>Tipo de contrato</th>
						                  <th colspan="3">Acciones</th>
						                </tr>
					                </thead>
					                <tbody>
					                	<?php for($i=0;$i<count($maestros);$i++){ ?>
					                		<tr>
					                			<td><?php echo ($i+1) ?></td>
					                			<td><?php echo $maestros[$i]['numero_empleado']; ?></td>
					                			<td><?php echo $maestros[$i]['nombre']." ".$maestros[$i]['paterno']." ".$maestros[$i]['materno']; ?></td>
					                			<td><?php echo $maestros[$i]['nombre_carrera']; ?></td>
					                			<td><?php echo $maestros[$i]['grado_academico']; ?></td>
					                			<td><?php echo $maestros[$i]['tipo_contrato']; ?></td>
					                			<td>
					                				<a type="button" class="btn btn-warning" href="c_modificar_maestro.php?id=<?php echo $maestros[$i]['id_persona']; ?>">
									                	<i class="fa fa-fw fa-edit"></i>
									              	</a>
									            </td>
					                			<td>
					                				<button type="button" class="btn btn-info" data-toggle="modal" name="btn_info" data-target="#modal-info" onclick="mostrar_datos('<?php echo $i; ?>');">
										             <i class="fa fa-fw fa-info-circle"></i>
										            </button>
					                			</td>
					                			<td>
					                				<a type="button" class="btn btn-danger" href="c_eliminar_maestro.php?id=<?php echo $maestros[$i]['id_persona']; ?>">
									                	<i class="fa fa-fw fa-trash"></i>
									              	</a>
									            </td>
					                		</tr>
					                	<?php } ?>
					                </tbody>
					                <tfoot>
					            		<tr>
						                  <th style="width: 10px;">#</th>
						                  <th>Número de empleado</th>
						                  <th>Nombre</th>
						                  <th>Carrera</th>
						                  <th>Grado académico</th>
						                  <th>Tipo de contrato</th>
						                  <th colspan="3">Acciones</th>
						                </tr>
					                </tfoot>
					              </table>
					          <?php } else{ ?>
					          	<div class="callout callout-info">
					          		<h3>No hay registros!</h3>
					          		<p>Actualmente no existen registros dentro de la base de datos para mostrar. Agrega uno nuevo.</p>
					          	</div>
					          <?php } ?>
					            </div>
				            </div>
				            <!-- /.box-body -->
				          </div>
          <!-- /.box -->
          				<div class="modal modal-info fade" id="modal-info">
				          <div class="modal-dialog">
				            <div class="modal-content">
				              <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                  <span aria-hidden="true">&times;</span></button>
				                <h4 class="modal-title">Información completa</h4>
				              </div>
				              <div class="modal-body">
				                <div class="box-body no-padding">
					              <table class="table table-condensed">
					                <tr>
					                  <td>1.</td>
					                  <td>Número de empleado:</td>
					                  <td id="td_numero_empleado"></td>
					                </tr>
					                <tr>
					                  <td>2.</td>
					                  <td>Nombre:</td>
					                  <td id="td_nombre_empleado"></td>
					                </tr>
					                <tr>
					                  <td>3.</td>
					                  <td>CURP:</td>
					                  <td id="td_curp"></td>
					                </tr>
					                <tr>
					                  <td>4.</td>
					                  <td>Correo:</td>
					                  <td id="td_correo"></td>
					                </tr>
					                <tr>
					                  <td>5.</td>
					                  <td>Teléfono móvil:</td>
					                  <td id="td_tmovil"></td>
					                </tr>
					                <tr>
					                  <td>6.</td>
					                  <td>Teléfono de casa:</td>
					                  <td id="td_tcasa"></td>
					                </tr>
					                <tr>
					                  <td>7.</td>
					                  <td>Fecha de nacimiento:</td>
					                  <td id="td_fechanac"></td>
					                </tr>
					                <tr>
					                  <td>8.</td>
					                  <td>Grado académico:</td>
					                  <td id="td_gradoacademico"></td>
					                </tr>
					                <tr>
					                  <td>9.</td>
					                  <td>Tipo de contrato:</td>
					                  <td id="td_tipocontrato"></td>
					                </tr>
					                <tr>
					                	<td>10.</td>
					                	<td>Carrera</td>
					                	<td id="td_nombrecarrera"></td>
					                </tr>
					              </table>
					            </div>
					            <!-- /.box-body -->
				              </div>
				              <div class="modal-footer">
				                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Okay</button>
				              </div>
				            </div>
				            <!-- /.modal-content -->
				          </div>
				          <!-- /.modal-dialog -->
				        </div>
					        <!-- /.modal -->
			        </div>
			    </div>

          	</section>
        </div>
    </div>
</body>
</html>
<?php include_once('include_js.php'); ?>

<script>
  $(function () {
    $('#mostrar_maestros').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  }) 

  function mostrar_datos(index){
  	var maestros=JSON.parse('<?php echo json_encode($maestros); ?>');
  	document.getElementById('td_numero_empleado').innerHTML=maestros[index].numero_empleado;
  	document.getElementById('td_tipocontrato').innerHTML=maestros[index].tipo_contrato;
  	document.getElementById('td_nombrecarrera').innerHTML=maestros[index].nombre_carrera;
  	document.getElementById('td_curp').innerHTML=maestros[index].curp;
  	document.getElementById('td_correo').innerHTML=maestros[index].correo;
  	document.getElementById('td_tcasa').innerHTML=maestros[index].telefono_casa;
  	document.getElementById('td_tmovil').innerHTML=maestros[index].telefono_movil;
  	document.getElementById('td_fechanac').innerHTML=maestros[index].fecha_nac;
  	document.getElementById('td_gradoacademico').innerHTML=maestros[index].grado_academico;
  	document.getElementById('td_nombre_empleado').innerHTML=(maestros[index].nombre+" "+maestros[index].paterno+" "+maestros[index].materno);
  }
</script>