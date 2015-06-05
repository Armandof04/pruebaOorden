 - <?=$this->tag->linkTo("index","Regresar"); ?>
<div class="row">
	<div class="col-md-8">
	<form action='' method='post' role="form">
			 <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
	                value="<?php echo $this->security->getToken() ?>"/>
		<div class="form-group">
					<?=$this->tag->textField(['sucursal_id', 'class' => 'form-control', "placeholder"=>"Sucursal"]);?>  
		</div>
		<div class="form-group">
					<?=$this->tag->textField(['organizacion_id', 'class' => 'form-control', "placeholder"=>"Organizacion"]);?> 
		</div>
		<div class="form-group">
					<?=$this->tag->textField(['clave', 'class' => 'form-control', "placeholder"=>"Clave"]);?> 
		</div>
		<div class="form-group">
					<?=$this->tag->textField(['nombre', 'class' => 'form-control', "placeholder"=>"Nombre"]);?>
		</div>
		<div class="form-group">
					<?=$this->tag->textField(['direccion', 'class' => 'form-control', "placeholder"=>"Dirección"]);?> 
		</div>
		<div class="form-group">
					<?=$this->tag->textField(['sucursalescol', 'class' => 'form-control', "placeholder"=>"Sucursal"] );?> 
		</div>
		<div class="form-group">
					Si <?=$this->tag->radioField(['default','Value' => 'S']);?>
					No <?=$this->tag->radioField(['default', 'Value' => 'N']);?>
		</div>
		<div class="form-group text-right">
					<?=$this->tag->submitButton(['Guardar',  "class"=>"btn btn-primary"]);?>
		</div>
	</form>
	</div>
</div>