Seccion Usuarios - <?=$this->tag->linkTo("index","Regresar"); ?>
<p>

<?=$this->tag->linkTo("usuarios/add","Agregar"); ?>
</p>

<table class="table table-striped">
	<tr>
		<th>ID
		</th>
		<th>Nombre del Usuario
		</th>
		<th colspan="3">
			acciones
		</th>
	</tr>

			<?php
	 			foreach ($listaUsuarios as $usuarios) {
	 				$link = $this->tag->linkTo("usuarios/edit/".$usuarios->usuario_id,"Editar");
	 				$link2 = $this->tag->linkTo("usuarios/delete/".$usuarios->usuario_id, 'Eliminar');
	 				$link3 = $this->tag->linkTo("usuarios/email/".$usuarios->usuario_id, 'email');
	 				echo "<tr>
	 						<td>{$usuarios->usuario_id} </td>
			 				<td> {$usuarios->nombre}</td>
			 				<td>{$link}</td>
			 				<td>{$link2}</td>
			 				<td>{$link3}</td>
			 			</tr>";
	 			}
			?>
		</td>
	</tr>
