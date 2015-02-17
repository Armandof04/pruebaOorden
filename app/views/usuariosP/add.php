 - <?=$this->tag->linkTo("index","Regresar"); ?>
<form action='' method='post'>
<table>
<tr>
	<td>
		<?=$this->tag->select(['usuario_id', $listaPermisos, 'using'=>['usuario_id', 'nombre'] ]);?>
	</td>
</tr>
<tr>
	<td>
		<?=$this->tag->submitButton('Submit');?>
	</td>
</tr>
</table>
</form>