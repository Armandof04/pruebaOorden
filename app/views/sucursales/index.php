<h3>Seccion Sucursales <small><?=$this->tag->linkTo("index","Regresar"); ?></small></h3>


<table class="table table-striped">
	<tr>
		<th>Sucursal ID
		</th>
		<th>Organizacion ID
		</th>
		<th>Clave
		</th>
		<th colspan="2">
			Acciones
		</th>
	</tr>
		<?php
	 		foreach ($listaSucursales as $sucursales) 
	 		{
	 			$link = $this->tag->linkTo("sucursales/edit/".$sucursales->sucursal_id,"Editar");
	 			$link2 = $this->tag->linkTo("sucursales/delete/".$sucursales->sucursal_id, 'Eliminar');
	 			echo "<tr>
					<td>{$sucursales->sucursal_id} </td>
	 				<td> {$sucursales->organizacion_id}</td>
	 				<td> {$sucursales->clave}</td>
	 				<td>{$link}</td>
	 				<td>{$link2}</td>
		 			</tr>";
 			}
			?>
		</td>
	</tr>
