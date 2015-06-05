
<h2 class="text-center">Tipo de Cambio</h2>

<ul class="list-inline">
  <li><?=$this->tag->linkTo("index","Regresar"); ?></li>
  <li><?=$this->tag->linkTo("tipoC/add","Actualizar"); ?>
</li>
</ul>





 <table class="table table-striped ">
	<tr>
		<th>ID</th>
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
			 				<td> {$tipo->moneda_origen}</td>
			 				<td> {$tipo->monto_origen}</td>
			 				<td> {$tipo->moneda_destino}</td>
			 				<td> {$tipo->monto_destino}</td>
			 				<td> {$tipo->fecha}</td>
			 				<td>
							    <a href='/tipoC/delete/{$tipo->id}'>
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
