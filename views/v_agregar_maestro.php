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


			<!-- Content Header (Page header) -->
			<section class="content-header">
			  <h1>
			    Maestros
			    <small>Agregar nuevo registro</small>
			  </h1>
			  <ol class="breadcrumb">
			    <li><a href="#"><i class="fa fa-dashboard"></i> Maestros</a></li>
			    <li class="active">Nuevo</li>
			  </ol>
			</section>

			<!-- Main content -->
			<section class="content container-fluid">
          <!-- general form elements -->

          <!-- general form elements -->

        <form role="form" class="invoice" style="background-color:#ecf0f5; border-color:#ecf0f5;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          
          <!-- DATOS PERSONALES !-->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos personales</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="nombrePersona">Nombre(s): </label>
                  <input type="text" class="form-control" id="nombrePersona" placeholder="Ejemplo de texto" name="nombre" required="">
                </div>
                <div class="form-group">
                  <label for="apellidoPaterno">Apellido Paterno</label>
                  <input type="text" class="form-control" id="apellidoPaterno" placeholder="" name="paterno" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Apellido Materno</label>
                  <input type="text" class="form-control" id="apellidoMaterno" placeholder="" required="" name="materno">
                </div>
                <div class="form-group">
                  <label for="curpPersona">CURP</label>
                  <input type="text" class="form-control" id="curpPersona" placeholder="" required="" name="curp">
                  <p class="help-block">Es recomendable verificar este campo más de una vez por el usuario.</p>
                </div>
                <div class="form-group">
                  <label for="nssPersona">NSS</label>
                  <input class="form-control" required="" type="text" id="nssPersona" name="nss">
                  <p class="help-block">Es recomendable verificar este campo más de una vez por el usuario.</p>
                </div>
                <div class="form-group">
                  <label for="correo">Correo</label>
                  <input type="email" class="form-control" id="correo" placeholder="" required="" name="correo">
                </div>
                <div class="form-group">
                  <label for="tel_movPersona">Teléfono móvil</label><div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="telefono_movil" required="">
                </div>
                </div>
                <div class="form-group">
                  <label for="nssPersona">Teléfono de casa</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="telefono_casa" required="">
                  </div>
                </div>
              
                <div class="form-group">
                  <label for="fechaNacimiento">Fecha de nacimiento:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="fechaNacimiento" name="fecha_nac" required="">
                </div>
                <!-- /.input group -->
              </div>
              </div>
              <!-- /.box-body -->
          </div>

          <!-- DATOS INSTITUCIONALES !-->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos institucionales</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="numeroEmpleado">Número de empleado</label>
                  <input type="number" class="form-control" id="numeroEmpleado" name="numero_empleado" placeholder="Ejemplo: 123456" required="">
                </div>
                <div class="form-group">
                  <label for="gradoAcademico">Grado académico</label>
                  <select class="form-control" id="gradoAcademico" name="grado_academico">
                  	<option value="Licenciatura">Licenciatura</option>
                  	<option value="Maestría">Maestría</option>
                  	<option value="Doctorado">Doctorado</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tipoContrato">Tipo de contrato</label>
                  <select class="form-control" id="tipoContrato" name="tipo_contrato">
                  	<option value="PA">Tiempo parcial</option>
                  	<option value="PTC">Tiempo completo</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="carreraMaestro">Carrera</label>
                  <select class="form-control" id="carreraMaestro" name="id_carrera">
                  	<?php for($i=0;$i<count($carreras);$i++){ ?>
                  		<option value="<?php echo $carreras[$i]['id'];?>"> <?php echo $carreras[$i]['nombre']; ?></option>
                  	<?php } ?>
                  </select>
                </div> 
              </div>
              <!-- /.box-body -->

      	<div class="box-footer">
        	<button type="submit" name="btn_registrar" class="btn btn-primary pull-right">Registrar</button>
      	</div>
	     </div>
    </form>
		</section>
<!-- /.content-wrapper -->

	</div>
</body>
</html>
<?php include_once('include_js.php'); ?>


<!-- Código js necesario !-->
<script>
  $(function () {

    $('[data-mask]').inputmask()//Valida la máscara para el teléfono

  })
</script>