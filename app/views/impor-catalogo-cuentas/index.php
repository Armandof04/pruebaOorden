
<div class="jumbotron">
  <h3>Importar Catalogo de Cuenta</h3>
  <h4>Seleccione  de donde proviene su catalogo de cuentas</h4>
  <p>Puede importar de diferente fuentes como COI, CONTPAQ y/o SIIGO en un archivo en formato xls</p>
      <p>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCoi">Importar</button>
      </p>
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
        	<?=$this->tag->form(["impor-catalogo-cuentas/subirCuenta", "method" => "post", "enctype" => "multipart/form-data", 'role'=>'form']);?>
			<div class="form-group">
				<div class="form-group">
        <label><h5>¿Origen del Catalogo?</h5></label>
        <br><blockquote>
          EXCEL <?=$this->tag->radioField(['fuente','Value' => 'excel']);?>
          COI <?=$this->tag->radioField(['fuente','Value' => 'coi']);?>
          CONTAPQ <?=$this->tag->radioField(['fuente', 'Value' => 'contpaq']);?>
          SIIGO <?=$this->tag->radioField(['fuente', 'Value' => 'siigo']);?>
        </blockquote>
        </div>      

        <div class="col-lg-12 col-sm-12 col-12" id = "seleccion" style="display: block;">
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Browse&hellip; <input type="file" name="file[]">
                    </span>
                </span>
                <input type="text" class="form-control" readonly>
            </div>
            <span class="help-block">
                Haga clic para importar un catalogo de cuenta
            </span>
        </div>

			</div>
				
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?=$this->tag->submitButton(['Importar',  "class"=>"btn btn-success"]);?>
      </div>
      	</form>
    </div>
  </div>
</div>