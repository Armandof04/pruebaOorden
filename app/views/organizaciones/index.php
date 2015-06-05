
<h3>Seccion Organizaciones -<small><?=$this->tag->linkTo("index","Regresar"); ?></small> </h3>

<table  class="table table-striped">
	<tr>
		<th class="a">ID
		</th>
		<th>Nombre
		</th>
		<th colspan="3">
			acciones
		</th>
		<th>Sucursales</th>
		<th>ID Usuarios</th>
	</tr>
	<?php
		foreach ($listaOrganizaciones as $organizacion) 
		{
	 		$link = $this->tag->linkTo("organizaciones/edit/".$organizacion->organizacion_id,"Editar");
	 		$link2 = $this->tag->linkTo("organizaciones/delete/".$organizacion->organizacion_id, 'Eliminar');
	 		$link3 = $this->tag->linkTo("usuariosP/add/".$organizacion->organizacion_id, 'Permisos');
	 		echo "<tr>
	 			<td>{$organizacion->organizacion_id} </td>
				<td> {$organizacion->nombre_legal}</td>
				<td>{$link}</td>
				<td class='a'>{$link2}</td>
				<td class='a'>{$link3}</td>
				<td id='suc'>
				";
			//imprimo lo referenciado de otras tavlas
			foreach ($organizacion->Sucursales as $valor) 
			{
				echo $valor->nombre.", ";
			}
			echo "</td><td>";
			foreach ($organizacion->UsuarioPermisos as $valor) 
			{
				echo $valor->Usuarios->nombre.", ";
			}
			echo "</td></tr>";			 			
	 	}
	?>
		</td>
	</tr>
