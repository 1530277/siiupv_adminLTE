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
			    <small>Modificar registro</small>
			  </h1>
			  <ol class="breadcrumb">
			    <li><a href="#"><i class="fa fa-dashboard"></i> Maestros</a></li>
			    <li class="active">Cambios</li>
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
                  <input type="text" name="id_persona" value="<?php echo $datos['id_persona']; ?>" style="display: none;">
                  <input type="text" class="form-control" id="nombrePersona" placeholder="" name="nombre" required="" value="<?php echo $datos['nombre']; ?>">
                </div>
                <div class="form-group">
                  <label for="apellidoPaterno">Apellido Paterno</label>
                  <input type="text" class="form-control" id="apellidoPaterno" placeholder="Ejemplo: Guzman" name="paterno" required="" value="<?php echo $datos['paterno']; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Apellido Materno</label>
                  <input type="text" class="form-control" id="apellidoMaterno" placeholder="" required="" name="materno" value="<?php echo $datos['materno']; ?>">
                </div>
                <div class="form-group">
                  <label for="curpPersona">CURP</label>
                  <input type="text" class="form-control" id="curpPersona" placeholder="" required="" name="curp" value="<?php echo $datos['curp']; ?>">
                  <p class="help-block">Es recomendable verificar este campo más de una vez por el usuario.</p>
                </div>
                <div class="form-group">
                  <label for="nssPersona">NSS</label>
                  <input class="form-control" required="" type="text" id="nssPersona" name="nss" value="<?php echo $datos['nss']; ?>">
                  <p class="help-block">Es recomendable verificar este campo más de una vez por el usuario.</p>
                </div>
                <div class="form-group">
                  <label for="correo">Correo</label>
                  <input type="email" class="form-control" id="correo" placeholder="" required="" name="correo" value="<?php echo $datos['correo']; ?>">
                </div>
                <div class="form-group">
                  <label for="tel_movPersona">Teléfono móvil</label><div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="telefono_movil" required="" value="<?php echo $datos['telefono_movil']; ?>">
                </div>
                </div>
                <div class="form-group">
                  <label for="nssPersona">Teléfono de casa</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="telefono_casa" required="" value="<?php echo $datos['telefono_casa']; ?>">
                  </div>
                </div>
              
                <div class="form-group">
                  <label for="fechaNacimiento">Fecha de nacimiento:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="fechaNacimiento" name="fecha_nac" required="" value="<?php echo $datos['fecha_nac']; ?>">
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
                  <input type="number" class="form-control" id="numeroEmpleado" name="numero_empleado" placeholder="" required="" value="<?php echo $datos['numero_empleado']; ?>">
                </div>
                <div class="form-group">
                  <label for="gradoAcademico">Grado académico</label>
                  <select class="form-control" id="gradoAcademico" name="grado_academico">
                    <?php 
                      $grado_academico=["Licenciatura","Maestria","Doctorado"];
                      for($i=0;$i<count($grado_academico);$i++){
                            if($grado_academico[$i]==$datos['grado_academico']){
                    ?>
                  	<option value="<?php echo $grado_academico[$i]; ?>" selected><?php echo $grado_academico[$i]; ?></option>
                  	 <?php }else{ ?>
                     <option value="<?php echo $grado_academico[$i]; ?>"><?php echo $grado_academico[$i]; ?></option>
                  	<?php }}?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tipoContrato">Tipo de contrato</label>
                  <select class="form-control" id="tipoContrato" name="tipo_contrato">
                  	<?php 
                      $tipo_contrato=[["PA","Tiempo Parcial"],["PTC","Tiempo completo"]];
                      for($i=0;$i<count($tipo_contrato);$i++){
                            if($tipo_contrato[$i][0]==$datos['tipo_contrato']){
                    ?>
                    <option value="<?php echo $tipo_contrato[$i][0]; ?>" selected><?php echo $tipo_contrato[$i][1]; ?></option>
                     <?php }else{ ?>
                     <option value="<?php echo $tipo_contrato[$i][0]; ?>"><?php echo $tipo_contrato[$i][1]; ?></option>
                    <?php }}?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="carreraMaestro">Carrera</label>
                  <select class="form-control" id="carreraMaestro" name="id_carrera">
                  	<?php for($i=0;$i<count($carreras);$i++){ 
                      if($carreras[$i]['id']==$datos['id_carrera']){
                        echo("id: ".$datos['id_carrera']);
                      ?>
                      <option value="<?php echo $carreras[$i]['id'];?>" selected><?php echo $carreras[$i]['nombre']; ?></option>
                    <?php }else{?>
                  		<option value="<?php echo $carreras[$i]['id'];?>"><?php echo $carreras[$i]['nombre']; ?></option>
                  	<?php }} ?>
                  </select>
                </div> 
              </div>
              <!-- /.box-body -->

      	<div class="box-footer">
        	<button type="submit" name="btn_guardar" class="btn btn-primary pull-right">Guardar cambios</button>
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