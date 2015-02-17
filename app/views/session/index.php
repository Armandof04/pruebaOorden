<?php

 if($this->session->has("username"))
        {
           echo $this->session->get("username");
        }
        else
        {
            echo "La sesión no existe<br>";
        }


         //Comprobamos si existe la cookie
        if ($this->cookies->has('remember-me')) 
        {
 
            //obtenemos la cookie
            $rememberMe = $this->cookies->get('remember-me');
 
            //obtenemos el valor de la cookie
            $value = $rememberMe->getValue();
            echo $value;
 
            //si la cookie está encriptada este es el resultado 
            //YA3njYIgfCYb19uHs91PG1NYnceD8BD1Ss9ujjGb%2FveeztZhrNbbflGnGg0Nd4g7Rz%2Fb5vgAOZvD6NZmqS%2BXSg%3D%3D
 
            //en otro caso
            //valor+de+la+cookie :(
        }
        else
        {
            echo "La cookie remember-me no existe";
        }




?>


<?=$this->tag->form('session/start')?>
<table>
    <tr>
        <td>    <label for="email">Usuario_ID</label>  </td>
    </tr>
    <tr>
        <td>    <?=$this->tag->textField(["usuario_id", "size" => "30"]);?>  </td>
    </tr>
    <tr>
        <td>    <label for="password">Contraseña</label>    </td>
    </tr>
    <tr>
        <td>    <?=$this->tag->passwordField(["password", "size" => "30"]);?>   </td>
    </tr>
    <tr>    
        <td>   <?=$this->tag->checkField(['cookie', 'value'=>1]);?> Mantener la sesión</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right;">
                <br>
                <?=$this->tag->submitButton('Aceptar');?>
        </td>
    </tr>
    <tr>
        <td><br></td>
    </tr>
    <tr>
        <td>
            ¿No estas registrado,  - <?=$this->tag->linkTo("usuarios/add","Registrate ahora"); ?>
        </td>
    </tr>
</table>
</form>

