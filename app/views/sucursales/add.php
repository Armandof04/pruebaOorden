 - <?=$this->tag->linkTo("index","Regresar"); ?>
<form action='' method='post'>
		 <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                value="<?php echo $this->security->getToken() ?>"/>

	<table>
		<tr>
			<td>
				Sucursal ID  <?=$this->tag->textField(['sucursal_id','size'=>30] );?>  int
		    </td>
		</tr>
		<tr>
		 	<td>
				organizacion   <?=$this->tag->textField(['organizacion_id','size'=>30] );?> int
		   </td>
		</tr>
		<tr>
			<td>
				clave    <?=$this->tag->textField(['clave','size'=>30] );?> varchar
		    </td>
		 </tr>
		<tr>
			<td>
				nombre    <?=$this->tag->textField(['nombre','size'=>30] );?> varchar
		<tr>
			<td>
				direccion    <?=$this->tag->textField(['direccion','size'=>30] );?> varchar
			</td>
		<tr>
			<td>
				default   <?=$this->tag->textField(['default','size'=>30] );?> S   o    N
		    </td>
		</tr>
		<tr>
			<td>
				sucursalescol   <?=$this->tag->textField(['sucursalescol','size'=>30] );?> varchar
		    </td>
		</tr>

		<tr>
			<td>
				<?=$this->tag->submitButton('Submit');?>
			</td>
		</tr>
	</table>
</form>