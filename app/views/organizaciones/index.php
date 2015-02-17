<head>
	<style type="text/css">
	#suc{
		max-width: 30px;
		height: auto;
	}
	table
	{ 
  		border-collapse: collapse; 
  		border: solid 1px;
  		border-color: gray;
  		border-bottom-color: blue;
	}
	th{
		background-color: yellow;

	}
	.a{
		padding-left: 5px;
		padding-right: -5px;
	}
	th, td
	{ 
  		border-collapse: collapse; 
  		border-top: solid 1px;
  		border-left: none;
  		border-color: blue;
  		padding-left: 15px;
  		margin: 15px;
  		
	}
	a{
		color:red;
	}
	</style>
	
</head>



Seccion Organizaciones - <?=$this->tag->linkTo("index","Regresar"); ?>
<p>
<?=$this->tag->linkTo("organizaciones/add","Agregar"); ?>
</p>


<table>
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
