<?php

        if($this->session->has("username"))
        {
          // echo $this->session->get("username");
        }
        else
        {
          //  echo "La sesión no existe<br>";
        }


         //Comprobamos si existe la cookie
        if ($this->cookies->has('remember-me')) 
        {
 
            //obtenemos la cookie
            $rememberMe = $this->cookies->get('remember-me');
 
            //obtenemos el valor de la cookie
            $value = $rememberMe->getValue();
         //   echo $value;
 
            //si la cookie está encriptada este es el resultado 
            //YA3njYIgfCYb19uHs91PG1NYnceD8BD1Ss9ujjGb%2FveeztZhrNbbflGnGg0Nd4g7Rz%2Fb5vgAOZvD6NZmqS%2BXSg%3D%3D
 
            //en otro caso
            //valor+de+la+cookie :(
        }
        else
        {
           // echo "La cookie remember-me no existe";
        }




?>

<div class="col-md-4 col-md-push-4">
<?=$this->tag->form(['action'=> 'session/start', 'role'=>'form'])?>

        <div class="form-group">
            <?=$this->tag->textField(["usuario_id", "size" => "30", "class"=>"form-control", "placeholder"=>"Usuario"  ]);?>  </td>
        </div>
        <div class="form-group">
            <?=$this->tag->passwordField(["password", "size" => "30", "class"=>"form-control", "placeholder"=>"Password"]);?>   </td>
        </div>
        <div class="form-group">
            <?=$this->tag->checkField(['cookie', 'value'=>1]);?> Mantener la sesión</td>
        </div>
        <div class="form-group text-right">
            <?=$this->tag->submitButton(['Aceptar', "class"=>"btn btn-primary"]);?>
        </div>
        <div class="form-group text-center">
        ¿No estas registrado,  - <?=$this->tag->linkTo("usuarios/add","Registrate ahora"); ?>
        </div>
</form>
</div>
