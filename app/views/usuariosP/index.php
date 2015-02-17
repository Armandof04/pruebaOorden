Permisos de Usuarios -<?=$this->tag->linkTo("index","Regresar"); ?>

<table>
	<tr>
		<th>Id del <br>Usuario
		</th>
		<th>ID de la <br>organizacion
		</th>
		<th colspan="2">
			acciones
		</th>
	</tr>

			<?php
	 			foreach ($listaUsuarios as $usuarios) {
	 			//	$link = $this->tag->linkTo("usuarios/edit/".$usuarios->usuario_id,"Editar");
	 				$link2 = $this->tag->linkTo("usuariosP/delete/".$usuarios->usuario_id, 'Eliminar');
	 				echo "<tr>
	 						<td>{$usuarios->usuario_id} </td>
			 				<td> {$usuarios->organizacion_id}</td>
			 				
			 				<td>{$link2}</td>
			 			</tr>";
	 			}
			?>
		</td>
	</tr>
