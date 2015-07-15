 - <?=$this->tag->linkTo("index","Regresar"); ?>
<form action='' method='post'>
	<input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                value="<?php echo $this->security->getToken() ?>"/>
	                
	<table>
		<tr>
			<td>
				Organizacion ID  <?=$this->tag->textField(['organizacion_id','size'=>30] );?>
		    </td>
		</tr>
		<tr>
		 	<td>
				Nombre Corto   <?=$this->tag->textField(['nombre_corto','size'=>30] );?>
		   </td>
		</tr>
		<tr>
			<td>
				Nombre Legal    <?=$this->tag->textField(['nombre_legal','size'=>30] );?>
		    </td>
		 </tr>
		<tr>
			<td>
				Pais ID    <?=$this->tag->textField(['pais_id','size'=>30] );?>
		<tr>
			<td>
				Logo    <?=$this->tag->textField(['logo','size'=>30] );?>
			</td>
		<tr>
			<td>
				Tipo ID   <?=$this->tag->textField(['tipo_id','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				ID de Zona Horaria   <?=$this->tag->textField(['id_zona_horaria','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Direccion Fiscal    <?=$this->tag->textField(['direccion_fiscal','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Direccion Fisica    <?=$this->tag->textField(['direccion_fisica','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Telefono    <?=$this->tag->textField(['telefono','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Email    <?=$this->tag->textField(['email','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Moneda Base ID   <?=$this->tag->textField(['moneda_base_id','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Multimoneda    <?=$this->tag->textField(['multimoneda','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Fin Año Fiscal    <?=$this->tag->textField(['fin_ano_fiscal','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Base Impuesto   <?=$this->tag->textField(['base_impuesto','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Clave Fiscal    <?=$this->tag->textField(['clave_fiscal','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Nombre Clave    <?=$this->tag->textField(['nombre_clave_fiscal_id','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Formato Cuentas    <?=$this->tag->textField(['formato_cuentas','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Periodo Fiscal    <?=$this->tag->textField(['periodo_fiscal_id','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Fecha de Bloqueo    <?=$this->tag->textField(['fecha_bloqueo_general','size'=>30]);?>
		    </td>
		</tr>
		<tr>
			<td>
				Fecha de Bloqueo restringido    <?=$this->tag->textField(['fecha_bloqueo_restringido','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				Nombre Costo    <?=$this->tag->textField(['nombre_ccosto_1','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				 Nombre costo 2   <?=$this->tag->textField(['nombre_ccosto_2','size'=>30] );?>
		    </td>
		</tr>
		<tr>
			<td>
				<?=$this->tag->submitButton('Submit');?>
			</td>
		</tr>
	</table>
</form>
<form>
		<input type="text" name="<?php echo $this->security->getTokenKey() ?>"
                value="<?php echo $this->security->getToken() ?>"/>

</form>