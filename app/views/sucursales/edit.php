 - <?=$this->tag->linkTo("sucursales","Regresar"); ?>
<form action='' method='post'>

	 <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                value="<?php echo $this->security->getToken() ?>"/>
				
	<table>
		<tr>
			<td>
		 		Sucursal ID  <?=$this->tag->textField(['sucursal_id','size'=>30, 'value'=> $viewRecord->sucursal_id] );?>  int
		    </td>
		</tr>
		<tr>
		 	<td>
				Organizacion ID   <?=$this->tag->textField(['organizacion_id','size'=>30, 'value'=> $viewRecord->organizacion_id] );?> int
		   </td>
		</tr>
		<tr>
			<td>
				Clave    <?=$this->tag->textField(['clave','size'=>30, 'value'=> $viewRecord->clave] );?> varchar
		    </td>
		 </tr>
		<tr>
			<td>
				Nombre    <?=$this->tag->textField(['nombre','size'=>30, 'value'=> $viewRecord->nombre] );?> varchar
		<tr>
			<td>
				Direccion    <?=$this->tag->textField(['direccion','size'=>30, 'value'=> $viewRecord->direccion] );?> varchar
			</td>
		<tr>
			<td>
				Default   <?=$this->tag->textField(['default','size'=>30, 'value'=> $viewRecord->default] );?> varchar
		    </td>
		</tr>
		<tr>
			<td>
				SucursalEscol   <?=$this->tag->textField(['sucursalescol','size'=>30, 'value'=> $viewRecord->sucursalescol] );?> varchar
		    </td>
		</tr>
		<tr>
			<td>
				<?=$this->tag->submitButton('Submit');?>
			</td>
		</tr>
	</table>
</form>