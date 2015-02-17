 <html>
 <head>
 <style type="text/css">
 	textarea{
 	width: 238px;
 	height: 100px;
 	}
 </style>
 	

 </head>
<body>

     - <?=$this->tag->linkTo("usuarios","Regresar"); ?>
    <form action='' method='post'>

      <table>
        <tr>
        	<td>
            Nombre del Usuario  
          </td>
          <td>
            <?=$this->tag->textField(['nombre','size'=>30, 'value'=> $mostrar->nombre] );?> 
          </td>
        </tr>
        <tr>
         	<td>
            email   
          </td>
          <td>
           	<?=$this->tag->textField(['email','size'=>30, 'value'=> $mostrar->email] );?>
          </td>
        </tr>
        <tr>
        	<td>
            Concepto  
          </td>
          <td>
          	<?=$this->tag->textArea(['mensaje'] );?> 
           </td>
        </tr>

        </tr>

        <tr>
        	<td>
             <?=$this->tag->submitButton('Enviar');?>
        	</td>
        </tr>
      </table>
    </form>
</body>
</html>