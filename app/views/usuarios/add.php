 - <?=$this->tag->linkTo("index","Regresar"); ?>
<form action='' method='post'>
 <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                value="<?php echo $this->security->getToken() ?>"/>
	<table>
		<tr>
			<td>
				Usuario ID  <?=$this->tag->textField(['usuario_id','size'=>30] );?>  int
		    </td>
		</tr>
		<tr>
		 	<td>
				email   <?=$this->tag->textField(['email','size'=>30] );?> varchar
		   </td>
		</tr>
		<tr>
			<td>
				Nombre    <?=$this->tag->textField(['nombre','size'=>30] );?> varchar
		    </td>
		 </tr>
		<tr>
			<td>
				Password    <?=$this->tag->textField(['password','size'=>30] );?> varchar
			</td>
		<tr>
			<td>
				   <?=$this->tag->hiddenField(['activo','size'=>30, 'value'=>'Y'] );?> 

			</td>
		<tr>
			<td>
			   <?=$this->tag->hiddenField(['fecha_registro','size'=>30, 'value'=>'2015-01-01 00:00:00'] );?> <!--datetime-->
		    </td>
		</tr>
		<tr>
			<td>
			  <?=$this->tag->hiddenField(['fecha_login','size'=>30] );?> <!--datetime-->
		    </td>
		</tr>
		<tr>
			<td>
			    <?=$this->tag->hiddenField(['intento_de_session','size'=>30] );?> <!--int-->
		    </td>
		</tr>
		<tr>
			<td>
			    <?=$this->tag->hiddenField(['ultimo_intento_de_session','size'=>30] );?> <!--bigint-->
		    </td>
		</tr>
		<tr>
			<td>
			   <?=$this->tag->hiddenField(['tiempo_session','size'=>30] );?> <!--bigint-->
		    </td>
		</tr>
		<tr>
			<td>
			   <?=$this->tag->hiddenField(['usuario_activacion_key','size'=>30] );?>   <!--varchar-->
		    </td>
		</tr>
		<tr>
			<td>
			  <?=$this->tag->hiddenField(['usuario_activacoin_email','size'=>30] );?>  <!--varchar-->
		    </td>
		</tr>
		<tr>
			<td>
			   <?=$this->tag->hiddenField(['usuario_activacoin_contrasena','size'=>30] );?>   <!--varchar-->
		    </td>
		</tr>

		<tr>
			<td>
				<?=$this->tag->submitButton('Submit');?>
			</td>
		</tr>
	</table>
</form>