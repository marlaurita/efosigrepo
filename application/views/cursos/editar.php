<?php 
	$rol = $this->ion_auth->get_users_groups()->row();
	
	$fechaini = $data->fecha_inicio;
	$fechafin = $data->fecha_fin;
	$newFechaini = explode("-",$fechaini);
	$newFechafin = explode("-",$fechafin);
	$fechaFormatini = $newFechaini[2]."-".$newFechaini[1]."-".$newFechaini[0];
	$fechaFormatfin = $newFechafin[2]."-".$newFechafin[1]."-".$newFechafin[0];
?>
<script>
$(document).ready(function(){
	$("#durspan").hide();
	$("#parspan").hide();

	$(".go").click(function(e){

		duracion = $("#duracion").val();
		participantes = $("#participantes").val();

		if (duracion < 1){
			$("#durspan").show();
			$(".fix-back").hide();
			e.preventDefault();
		} else {
			$("#durspan").hide();
			$(".fix-back").show();
		}

		if (participantes < 1){
			$("#parspan").show();
			$(".fix-back").hide();
			e.preventDefault();
		} else {
			$("#parspan").hide();
			$(".fix-back").show();
		}
	});
	
	$("#inispan").hide();
	$("#finspan").hide();
	$("#fechaini").datepicker();
	$("#fechafin").datepicker();
	
	$("#fechaini").change(function () {
		
			fechaini = $("#fechaini").val();
			
			if(fechaini){
				$("#inispan").hide();
			}else{
				$("#inispan").show();
			}
	});
	
	$("#fechafin").change(function () {
		
			fechafin = $("#fechafin").val();
			
			if(fechafin){
				$("#finspan").hide();
			}else{
				$("#finspan").show();
			}
	});

});
</script>
</script>
<h1>Editar Curso</h1>
<hr>
<div class="auth-form" ng-controller="cursosController as uni" ng-app="cursos">

	<?php
	    $d=array('name' => 'form');
		echo form_open(base_url().'api/cursos_api/update',$d);
	?>
	<input type="hidden" name="id" value="<?php echo $data->id_curso; ?>">
	<input type="hidden" name="prev" value="<?php echo $data->id_estado; ?>">
	<div class="col-lg-6">
	   <p>
			<label for="nombre">Nombre del Curso:</label><br>
			<textarea id="nombre" required class="auth-input auth-textarea" type="text" name="nombre" rows="2"><?php echo $data->nombre; ?></textarea>

	   </p>

	   <p>
			<label for="duracion">Duraci&oacute;n (Horas):</label><br>
			<input id="duracion" class="auth-input" type="number" value="<?php  echo $data->duracion; ?>" name="duracion"required></input>
			<span id="durspan" style="color:red; font-size:12px"><br>* Este campo debe ser un numero entero</span>

	  
	  </p>

	   <p>
		   <label for="participantes">Participantes:</label><br>
			<input id="participantes" class="auth-input" type="number" value="<?php  echo $data->nro_participantes; ?>" name="participantes"required></input>
			<span id="parspan" style="color:red; font-size:12px"><br>* Este campo debe ser un numero entero</span>

	   </p>
	</div>
	
	<div class="col-lg-6">

	   <p>
			<label for="estado">Estado:</label><br>
			<select class="auth-input" name="estado" style="max-width: 300px !important; text-align: center; text-transform:uppercase;" required>
			<option selected value="<?php echo $data->id_estado; ?>"> <?php echo $data->estado; ?> </option>
			 <?php 
				foreach($list as $key){
						 
						echo "<option value='".$key->id_estado."'>".$key->nombre."</option>";
			
					}
			 ?>
			 </select>
		</p>
		
		<p>
			<label for="estatus">Estatus:</label><br>
			<?php if ($data->status == 1){ ?>
			<div class="switch">
				<input type="radio" class="switch-input" name="estatus" value="1" id="est1" checked required>
				<label for="est1" class="switch-label switch-label-off" >On</label>
				<input type="radio" class="switch-input" name="estatus" value="0" id="est0" required>
				<label for="est0" class="switch-label switch-label-on" >Off</label>
				<span class="switch-selection"></span>
			</div>
			<?php }else{ ?>
			<div class="switch">
				<input type="radio" class="switch-input" name="estatus" value="1" id="est1" required>
				<label for="est1" class="switch-label switch-label-off" >On</label>
				<input type="radio" class="switch-input" name="estatus" value="0" id="est0" checked required>
				<label for="est0" class="switch-label switch-label-on" >Off</label>
				<span class="switch-selection"></span>
			</div>
			<?php } ?>		
		</p>
		
		<p>
			<label for="fecha">Fecha de Inicio:</label><br>
			<input name="fechaini"class="auth-input" type="text" id="fechaini" value="<?php  echo $fechaFormatini; ?>" readonly  required>
			<span id="inispan" style="color:red; font-size:12px"><br>* Este campo es obligatorio</span>
		</p>

		<p>
			<label for="fecha">Fecha de Fin:</label><br>
			<input name="fechafin" class="auth-input" type="text" value="<?php  echo $fechaFormatfin; ?>" id="fechafin" readonly required>
			<span id="finspan" style="color:red; font-size:12px"><br>* Este campo es obligatorio</span>
		</p>
	</div>
	
	<div class="col-lg-12">
		<a class="auth-button .btn-danger b" style="position: absolute; margin-left: -140px;" href="<?php echo base_url()?>Cursos">Volver</a>
		<p>
			
			 <input type="submit" class="auth-button .btn-success go" value="Guardar" name="submit"></input>
			 
		</p>

	   <?php echo form_close(); ?>
		
	</div>
</div>