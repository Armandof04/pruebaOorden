<?php
        echo "<p>  Bienvenido ".$mostrarUsuario->nombre.'<br>';
        $link = $this->tag->linkTo("organizaciones/","Organizaciones");
        $link2 = $this->tag->linkTo("sucursales/",'Sucursales');
        $link3 = $this->tag->linkTo("usuarios/",'Usuarios');
        $link4 = $this->tag->linkTo("usuariosP/",'Permisos de Usuarios');
        $link5 = $this->tag->linkTo("session/destroy/", 'Cerrar Sesion');
        echo "<ul>
                <li>{$link}</li>        
                <li>{$link2}</li>            
                <li>{$link3}</li>
                <li>{$link4}</li>
              </ul>       
              <p>
              {$link5}
              </p><br>";

     
    ?>           
            