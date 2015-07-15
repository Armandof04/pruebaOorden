<script type="text/javascript">
    $("#button").click(function(){
    alert("The paragraph was clicked.");
    });

</script>

<?php
        echo "<p>  Bienvenido ".$mostrarUsuario->nombre.'<br>';
        $link = $this->tag->linkTo("organizaciones/","Organizaciones");
        $link2 = $this->tag->linkTo("sucursales/",'Sucursales');
        $link3 = $this->tag->linkTo("usuarios/",'Usuarios');
        $link4 = $this->tag->linkTo("usuariosP/",'Permisos de Usuarios');
        $link5 = $this->tag->linkTo("tipoC/",'Tipo de Cambio C');
        $link51 = $this->tag->linkTo("tipoB/",'Tipo de Cambio B');
        $link6 = $this->tag->linkTo("session/destroy/", 'Cerrar Sesion');
        echo "<ul>
                <li>{$link}</li>        
                <li>{$link2}</li>            
                <li>{$link3}</li>
                <li>{$link4}</li>
                <li>{$link5}</li>
                <li>{$link51}</li>

              </ul>       
              <p>
              {$link6}
              </p><br>";

     
    ?>           
            