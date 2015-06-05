<div class="row">
  <div class="col-lg-12">
    <div class="page-header">
      <h1 id="container">Importar Catalogo de Cuentas</h1>
    </div>
    <div class="bs-component">
      <div class="jumbotron">
        <h3>Seleccione  de donde proviene su catalogo de cuentas</h3>
        <p>Puede importar de diferente fuentes como COI, CONTPAQ y/o SIIGO en un archivo en formato xls</p>
        <p>
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCoi">Importar</button>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCoi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Importe Catalogo de Cuentas</h4>
      </div>
      <div class="modal-body">
        <p>
        	<?=$this->tag->form(["impor-catalogo-cuentas/uploadCoi", "method" => "post", "enctype" => "multipart/form-data", 'role'=>'form']);?>
			<div class="form-group">
				
				<?=$this->tag->fileField("file[]");?>
				<p class="help-block">Haga clic para importar un catalogo de cuenta</p>
			</div>
			<div class="form-group">
				<label>¿Origen del Catalogo?</label>
					COI <?=$this->tag->radioField(['default','Value' => 'S']);?>
					CONTAPQ <?=$this->tag->radioField(['default', 'Value' => 'N']);?>
					SIIGO <?=$this->tag->radioField(['default', 'Value' => 'N']);?>
			</div>				
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?=$this->tag->submitButton(['Importar',  "class"=>"btn btn-primary"]);?>
      </div>
      	</form>
    </div>
  </div>
</div>


