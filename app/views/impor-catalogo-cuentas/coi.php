<h3 class="text-center">Importar desde Coi</h3>
<div class="container">
	<div class="row">
		<div class="text-left"><?=$this->tag->linkTo('index', 'Regresar');?></div>
		<div>
			<?=$this->tag->form(["impor-catalogo-cuentas/coi", "method" => "post", "enctype" => "multipart/form-data", 'role'=>'form']);?>
			<div class="form-group">
				<label for="file">Importar Catalogo Cuentas</label>
				<?=$this->tag->fileField("file[]");?>
				<p class="help-block">Seleccione un catalgo de cuentas importado desde COI.</p>
			</div>
			<div class="form-group">
				
			</div>
			<div class="form-group">
				<?=$this->tag->submitButton(['Aceptar',  "class"=>"btn btn-primary"]);?>
			</div>				
			</form>
		</div>
	</div>
</div>