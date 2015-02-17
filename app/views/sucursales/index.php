Seccion Sucursales - <?=$this->tag->linkTo("index","Regresar"); ?>
<p>
<?=$this->tag->linkTo("sucursales/add","Agregar"); ?>
</p>
<style type="text/css">
	th{
		background-color: gray;
		border-color: gray;
	}

</style>
<table>
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
