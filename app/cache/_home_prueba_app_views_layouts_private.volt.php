<?php
      
      	 $link = $this->tag->linkTo("index/","Inicio");  
        $link1 = $this->tag->linkTo("organizaciones/","Organizaciones");
        $link2 = $this->tag->linkTo("sucursales/",'Sucursales');
        $link3 = $this->tag->linkTo("usuarios/",'Usuarios');
        $link4 = $this->tag->linkTo("usuariosP/",'Permisos');
        $link5 = $this->tag->linkTo("tipoC/",'Tipo de Cambio C');
        $link51 = $this->tag->linkTo("tipoB/",'Tipo de Cambio B');
        $link6 = $this->tag->linkTo("session/destroy/", 'Cerrar Sesion');
        $link7 = $this->tag->linkTo("impor-catalogo-cuentas/", 'Importar');

       /* echo "<ul>
                <li>{$link}</li>        
                <li>{$link2}</li>            
                <li>{$link3}</li>
                <li>{$link4}</li>
                <li>{$link5}</li>
                <li>{$link51}</li>
<?=$link2;?>
echo "<p>  Bienvenido ".$mostrarUsuario->nombre.'<br>';
              </ul>       
              <p>
              {$link6}
              </p><br>";
*/
      ?>           
  


  <div class="bs-docs-section clearfix">
        <div class="row">
          <div class="col-lg-12">
            

            <div class="bs-component">
              <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Prueba Oorden</a>
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li class="active"><?=$link;?> <span class="sr-only">(current)</span></li>
                       <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Organizaciones <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><?=$link1;?></li>
                            <li><?=$this->tag->linkTo("organizaciones/add","Agregar"); ?></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sucursales <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><?=$link2;?></li>
                            <li><?=$this->tag->linkTo("sucursales/add","Agregar"); ?></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Usuarios <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#"><?=$link3;?></a></li>
                          <li><a href="#"><?=$link4;?></a></li>
                        </ul>
                      </li>

                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tipo de Cambio <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#"><?=$link5;?></a></li>
                          <li><a href="#"><?=$link51;?></a></li>
                        <!--
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                          <li class="divider"></li>
                          <li><a href="#">One more separated link</a></li>
                        -->
                        </ul>
                      </li>
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Importar CC <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><?=$link7;?></li>
                        </ul>
                      </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li><?=$link6;?></li>
                    </ul>
                  </div>
                </div>
              </nav>
            </div>

          </div>
        </div>
      </div>
<div class="container">
	<div class= "row">
  		<?php echo $this->getContent(); ?>
  </div>
</div>