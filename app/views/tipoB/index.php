
<h2 class="text-center">Tipo de Cambio<small><?=date('y/m/d')?></small></h2>

<ul class="list-inline">
  <li><?=$this->tag->linkTo("index","Regresar"); ?></li>
  <li><?=$this->tag->linkTo("tipoB/addEx","Actualizar XE"); ?></li>
  <li><?=$this->tag->linkTo("tipoB/addDof","Actualizar DOF"); ?></li>
  <li><?=$this->tag->linkTo("tipoB/addDofg","Actualizar DOF.GOB.MX"); ?></li>
  <li><?=$this->tag->linkTo("tipoB/addBanamex","Actualizar Banamex"); ?></li>
</ul>





 <table class="table table-striped ">
	<tr>
		<th>ID</th>
		<th>Fuente</th>
		<th>Divisa Origen</th>
		<th>Monto Origen</th>
		<th>Divisa Destino</th>
		<th>Monto Destino</th>
		<th>Fecha</th>
		<th></th>

	</tr>

			<?php
	 			foreach ($tipoCambio as $tipo) {

	 				echo "<tr>
	 						<td>{$tipo->id} </td>
	 						<td>{$tipo->fuente} </td>
			 				<td> {$tipo->moneda_origen}</td>
			 				<td> {$tipo->monto_origen}</td>
			 				<td> {$tipo->moneda_destino}</td>
			 				<td> {$tipo->monto_destino}</td>
			 				<td> {$tipo->fecha}</td>
			 				<td>
							    <a href='/tipoB/delete/{$tipo->id}'>
							    <button type='submit' class='btn btn-default'>
							      <span class='glyphicon glyphicon-trash'></span>
							    </button>
							    </a>
							 </td>

			 			</tr>";
	 			}
			?>
		</td>
	</tr>
