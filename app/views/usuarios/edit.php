Seccion Usuarios - <?=$this->tag->linkTo("index","Regresar"); ?>
<form action='' method='post'>
	 <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                value="<?php echo $this->security->getToken() ?>"/>

	<table>
		<tr>
			<td>
				Usuario ID  <?=$this->tag->textField(['usuario_id','size'=>30, 'value'=> $viewRecord->usuario_id] );?>  int
		    </td>
		</tr>
		<tr>
		 	<td>
				email   <?=$this->tag->textField(['email','size'=>30, 'value'=> $viewRecord->email] );?> varchar
		   </td>
		</tr>
		<tr>
			<td>
				Nombre    <?=$this->tag->textField(['nombre','size'=>30, 'value'=> $viewRecord->nombre] );?> varchar
		    </td>
		 </tr>
		<tr>
			<td>
				Password    <?=$this->tag->textField(['password','size'=>30, 'value'=> $viewRecord->password] );?> varchar
		<tr>
			<td>
				Activo    <?=$this->tag->textField(['activo','size'=>30, 'value'=> $viewRecord->activo] );?> varchar
			</td>
		<tr>
			<td>
				Fecha de Registro   <?=$this->tag->textField(['fecha_registro','size'=>30, 'value'=> $viewRecord->fecha_registro] );?> datetime
		    </td>
		</tr>
		<tr>
			<td>
				Fecha Login   <?=$this->tag->textField(['fecha_login','size'=>30, 'value'=> $viewRecord->fecha_login] );?> datetime
		    </td>
		</tr>
		<tr>
			<td>
				Intento de Session    <?=$this->tag->textField(['intento_de_session','size'=>30, 'value'=> $viewRecord->intento_de_session] );?> int
		    </td>
		</tr>
		<tr>
			<td>
				Ultimo intento de session    <?=$this->tag->textField(['ultimo_intento_de_session','size'=>30, 'value'=> $viewRecord->ultimo_intento_de_session] );?> bigint
		    </td>
		</tr>
		<tr>
			<td>
				Tiempo de session    <?=$this->tag->textField(['tiempo_session','size'=>30, 'value'=> $viewRecord->tiempo_session] );?> bigint
		    </td>
		</tr>
		<tr>
			<td>
				Usuario acivacion key    <?=$this->tag->textField(['usuario_activacion_key','size'=>30, 'value'=> $viewRecord->usuario_activacion_key] );?>   varchar
		    </td>
		</tr>
		<tr>
			<td>
				usaurio activacion email   <?=$this->tag->textField(['usuario_activacoin_email','size'=>30, 'value'=> $viewRecord->usuario_activacoin_email] );?>  varchar
		    </td>
		</tr>
		<tr>
			<td>
				Usuario activacion contraseña    <?=$this->tag->textField(['usuario_activacoin_contrasena','size'=>30, 'value'=> $viewRecord->usuario_activacoin_contrasena] );?>   varchar
		    </td>
		</tr>

		<tr>
			<td>
				<?=$this->tag->submitButton('Submit');?>
			</td>
		</tr>
	</table>
</form>