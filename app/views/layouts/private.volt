<?php
      
      	$link = $this->tag->linkTo("index/","Inicio");  
        $link1 = $this->tag->linkTo("organizaciones/","Organizaciones");
        $link2 = $this->tag->linkTo("sucursales/",'Sucursales');
        $link3 = $this->tag->linkTo("usuarios/",'Usuarios');
        $link4 = $this->tag->linkTo("usuariosP/",'Permisos');
        $link5 = $this->tag->linkTo("tipoC/",'Tipo de Cambio C');
        $link51 = $this->tag->linkTo("tipoB/",'Tipo de Cambio B');
        $link6 = $this->tag->linkTo("session/destroy/", 'Cerrar Sesión');
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
  


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Oorden<small> prueba</small></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li class="active"><?=$link?></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Prueba Oorden<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><?=$link1?></li>
            <li><?=$link2?></li>
            <li class="divider"></li>
            <li><?=$link3?></li>
            <li><?=$link4?></li>  
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tipo de Cambio<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><?=$link5?></li>
            <li><?=$link51?></li>  
          </ul>
        </li>
        <li><?=$link7?></li>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><?=$link6?></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
	<div class= "row">
  		{{ content() }}
  </div>
</div>