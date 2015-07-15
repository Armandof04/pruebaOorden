<?php

namespace prueba\Controllers;

use prueba\Models as Modelos;


class ImporCatalogoCuentasController extends \Phalcon\Mvc\Controller
{
 /**
     * Default action. Set the private (authenticated) layout (layouts/private.volt)
     */
    public function initialize()
    {
        $this->view->setTemplateBefore('private');

          // Add some local CSS resources
        $this->assets
            ->addCss('css/fileInput.css');

        // and some local javascript resources
        $this->assets
            ->addJs('js/fileInput.js');
    }


    /**
    * function indexAction
    * muestra los registros de la tabla Usuario_Permisos 
    */

    public function indexAction()
    {
        //Manda llamar un metodo static
        $this->view->setVar("tipoCambio", Modelos\TipoCambio::find());

      //  echo class_exists('PHPExcel_IOFactory');
      //  die();
    }

    /**
    * function addAction
    * agrega un registro, regitrando el ID de organizacion al que corresponde
    * @param $id varchar recibe la id de la Organizacion al cual el usuario tendra permiso
    * @return void
    */
    public function coiAction()
    {
        //comprueba si hay archivos por subir
        if ($this->request->hasFiles() == true) 
        {
            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {
 
                //Print file details
                echo $file->getName(), " ", $file->getSize(), "\n";
 
                //guardamos dentro del directorio img
                if($file->moveTo('coi/' . $file->getName()))
                    {
                        $this->flash->success("Archivo ".$file->getName()." subido correctamente");
                    //    return $this->dispatcher->forward(["action" => "index"]);
                    }
                else
                    $this->flash->error("Error al cargar el archiv  ".$file->getName().". Intente nuevamente");
            }
        }
    } 

    public function subirCuentaAction()
    {
        $id_organizacion = '62a295f7-eeda-4168-a5ea-88f252042b61';
      

        //comprueba si hay archivos por subir
        if ($this->request->hasFiles() == true) 
        {
            $fuente = $this->request->getPost('fuente','string');
            if(empty($fuente) || $fuente == null)
            {  
             $this->flash->warning("Selecciona la fuente del catalogo");  
             return $this->dispatcher->forward(["action" => "index"]);
            }

            // Print the real file names and sizes|
            foreach ($this->request->getUploadedFiles() as $file) {
            
                //Print file details
                echo $file->getName(), " ", $file->getSize(), "\n";

                if(!is_dir("./excel_files/")) //se comprueba si la carpeta existe
                 mkdir("./excel_files/", 0777); //si no existe, se crea y se dan permisos de escritura y lectura

                //guardamos dentro del directorio excel_files
                if($file->moveTo('./excel_files/' . $file->getName()))
                {
                    $this->flash->notice("Archivo ".$file->getName()." subido correctamente");

                    //obtenemos la extensión del archivo
                    $extension = explode(".", $file->getName());
                    //print_r($extension);

                    if($extension[1] != "xlsx" && $extension[1] != "xls") 
                    {
                        
                        unlink("./excel_files/".$file->getName()); //elimino el archivo
                        $this->flash->warning("Formato no compatible, solo se permite &#34;XLS&#34; y &#34;XLSX&#34;");
                        return $this->dispatcher->forward(["action" => "index"]);

                    }

                    $this->flash->notice("Archivo ".$extension  [1]);
                    $file = './excel_files/' . $file->getName(); //acortamos el nombre y ruta del archivo

                   /** PHPExcel **/           
                   
                    $objPHPExcel = \PHPExcel_IOFactory::load($file);
                    $objWorksheet = $objPHPExcel->getActiveSheet();
                    

                    
                    $fila =0;
                    
                    foreach ($objWorksheet->getRowIterator() as $row)
                    {
                        $fila +=1;
                       
                        //Se crea el UID
                        $data = openssl_random_pseudo_bytes( 16 );
                        $data[6] = chr( ord( $data[6] ) & 0x0f | 0x40 ); // set version to 0100
                        $data[8] = chr( ord( $data[8] ) & 0x3f | 0x80 ); // set bits 6-7 to 10

                        $id = vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split( bin2hex( $data ), 4 ) ); 

                        
                        if($fila != 1)    $arreglo[$fila]['id']=$id;

                      
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
                        // even if it is not set.
                        // By default, only cells
                        // that are set will be
                        // iterated.
                        $celda = 0;

                       
                            
                            switch ($fuente) 
                            {
                                case 'excel':
                                    
                                    $titulo=array('numCuenta', 'nombre', 'descripcion', 'tipo_id', 'naturaleza', 'codigoOficial', 'moneda', 'numeroCheque' );

                                    foreach ($cellIterator as $cell) 
                                    {   
                                        //  echo '<td>'. $cell->getValue() . '</td>' . "\n";
                                        if($celda <=8 && $fila != 1) //En archivos 2007 o superiores detecta celdas null como activas
                                        {   
                                            $arreglo[$fila][$titulo[$celda]]=$cell->getValue();
                                        }
                                        $celda +=1;
                                    }  
                                    break;
                                case 'coi':
                                    $titulo=array('numCuenta', 'codigoOficial', 'naturaleza', 'nombre', 'moneda', 'numeroCheque' );

                                    $bandera = 0;
                                    
                                    foreach ($cellIterator as $cell) 
                                    {  
                                        if($cell->getValue() != "-" && $cell->getValue() != "" )
                                        {   
                                            $bandera = 1;
                                        }   
                                        
                                        if($bandera == 1)
                                        {
                                             if($celda <=8 && $fila != 1) //En archivos 2007 o superiores detecta celdas null como activas
                                            {   
                                                $arreglo[$fila][$titulo[$celda]]=$cell->getValue()." :: ".$bandera." :: ".$fila."::".$titulo[$celda];
                                            }
                                                $arreglo[$fila]['tipo_id']=$celda;
                                                $arreglo[$fila]['descripcion']=$bandera;

                                                $celda +=1;
                                        }

                                        
                                        
                                    }
                                    break;
                                
                                default:
                                           $this->flash->error("No ha seleccionado");                    
                                    break;
                            }

                            
                          
                    }

                //    echo "Bandera: ".$bandera."<br><pre>";
                //    var_dump($arreglo);
                //    echo "</pre>";
                //            die();

                    $numFilas =  count($arreglo);
                    
                    $this->view->setVar('numFilas', $numFilas);
                    $this->view->setVar('cuentas', $arreglo);
                    return $this->dispatcher->forward(["action" => "subirCuenta"]);

                }
                else
                { 
                    $this->flash->warning("Error al cargar el archiv  ".$file->getName().". Intente nuevamente");
                   // return $this->dispatcher->forward(["action" => "index"]);
                }
            }
        }//endIf si no existen archivos por subir

        elseif($this->request->isPost())
        {
            /*
            Ya tenemos el arreglo con los datos y a cuantos subniveles, ahora vamos a agregar a que subnivel pertenecec
            */

           $numFilas=$this->request->getPost('numFilas','string');

           


           for($i=2; $i<=$numFilas;$i++)
           {
                $cuenta[$i]['id']=$this->request->getPost('id'.$i,'string');
                $cuenta[$i]['numCuenta']=$this->request->getPost('numCuenta'.$i,'string');
                $cuenta[$i]['nivel']=explode("-", $cuenta[$i]['numCuenta']);
                $cuenta[$i]['nivel']=count($cuenta[$i]['nivel']);
                $cuenta[$i]['nombre']=$this->request->getPost('nombre'.$i,'string');
                $cuenta[$i]['descripcion']=$this->request->getPost('descripcion'.$i,'string');
                $cuenta[$i]['tipo_id']=$this->request->getPost('tipo_id'.$i,'string');
                $cuenta[$i]['naturaleza']=$this->request->getPost('naturaleza'.$i,'string');
                $cuenta[$i]['codigoOficial']=$this->request->getPost('codigoOficial'.$i,'string');
                $cuenta[$i]['moneda']=$this->request->getPost('moneda'.$i,'string');
                $cuenta[$i]['numeroCheque']=$this->request->getPost('numeroCheque'.$i,'string');
           }

            if (!empty($cuenta) && is_array($cuenta)):  //Si existe el arrego
                $fila = 35;//Variable temporal, solo para hacer la comprovacion



                for ($fila=2; $fila <= $numFilas; $fila++):
                    
            


                    $id = $cuenta[$fila]['id'];
                    $numCuenta = $cuenta[$fila]['numCuenta'];
                    $nC = $cuenta[$fila]['nivel'];



                     $numCuenta = explode('-', $numCuenta);

                    /*Verificamos que no sea una cuenta padre*/
                    $suma = 0;
                    for ($i= 1; $i<$nC; $i++)//se suman los subniveles del 1 a n, 
                    {
                        $suma = $numCuenta[$i]+$suma;  
                    }

                    if($suma == 0) // si el valor es igual a cero es una cuenta padre
                        $caso = 1;   
                    else 
                        $caso =2; // Pertenece a una cuenta Padre
                    
                    switch ($caso) 
                    {
                        case 1: //si es cuenta Padre, verifico que no este repetida

                            for ($i=2; $i <= $numFilas; $i++) // creo un ciclo for para pasar por todos los arreglos, realizando la busqueda
                            {
                                if(($cuenta[$i]['nivel'] == $nC) and ($cuenta[$i]['id'] != $id)) // solo comparare los que tengan el mismo nivel
                                {

                                    $divCuenta = explode("-",$cuenta[$i]['numCuenta']);
                                                         
                                    for($a = 0 ; $a < $nC; $a++)
                                    {
                                        
                                        if($divCuenta[$a] == $numCuenta[$a] || strcmp($divCuenta[$a],$numCuenta[$a])==0)
                                        {
                                            $comparar[$a]=$divCuenta[$a];
                                        }
                                        else                                            
                                            break;  
                                    }
                                }
                                else
                                {
                                    $comparar='';
                                } 
                            }
                            if($comparar == $numCuenta)
                            {   
                                $cuenta[$fila]['error'] = 1; 
                                $cuenta[$fila]['cuentaPadre']   =  '';

                            }
                            else
                            {

                                $cuenta[$fila]['cuentaPadre']   =  '';
                                $cuenta[$fila]['error'] = 0;
                            }

                            unset($comparar);                            
                            break;
                            
                        case 2: //Si no es cuenta Padre
                            /*Creo la probable cuenta Padre*/


                            $i=0;
                            while(true){
                                if($numCuenta[$i] < 1)
                                {
                                    for ($j=0; $j <= $i; $j++) 
                                    { 
                                        if($i == $j)
                                        {   $j = $j -1;
                                          
                                            $vB[$j]= 0;
                                            break;
                                        }    
                                        else
                                            $vB[$j]=$numCuenta[$j];    
                                    }
                                    break;
                                }
                               
                            
                                $i++;
                                if ($i >= $nC){
                                    for ($j=0; $j <= $i; $j++) 
                                    { 
                                        if($i == $j)
                                        {   $j = $j -1;
                                            $vB[$j]= 0;
                                            break;
                                        }    
                                        else
                                            $vB[$j]=$numCuenta[$j];    
                                    }
                                    break;

                                }
                            }


                            $contarVB=count($vB); //cuenta el numero de arrayas que trae el valor a buscar

                         //   echo "direfencia es nC".$nC.'  contarVB'.$contarVB;

                            $diferencia = $nC - $contarVB;  // y lo compara con el nivel de la cuenta

                            if($diferencia != 0) // acompletaremos los niveles faltantes
                            {
                               // echo "diferencia ".$diferencia."<br>";
                                $i=0;
                                while ($i < $diferencia) {
                                    
                                    
                                   $vB[]=0;
                                    $i++;
                                }

                            }

                                

                                for ($i=2; $i <= $numFilas; $i++): // creo un ciclo for para pasar por todos los arreglos, realizando la busqueda
                                    
                                    if(!empty($comparar) && $comparar == $vB) //Si se encontro la variable, corto el ciclo
                                    { 
                                     $cuenta[$fila]['cuentaPadre']   =    $valorEncontrado['id'];
                                      $cuenta[$fila]['error'] = 0; 
                                     break; 
                                    };
                                    
                                    if(( $cuenta[$i]['nivel'] == $nC ) and ( $cuenta[$i]['id'] != $id )) // solo comparare los que tengan el mismo nivel
                                    {

                                        $divCuenta = explode("-",$cuenta[$i]['numCuenta']);

                                        for($a = 0 ; $a < $nC; $a++)
                                        {
                                            
                                            if($divCuenta[$a] == $vB[$a] || strcmp($divCuenta[$a],$vB[$a])==0)
                                            {
                                                if($a == 0)
                                                    $valorEncontrado['id']= $cuenta[$i]['id'];
                                                
                                                $valorEncontrado[$a]=$divCuenta[$a];
                                                $comparar[$a]=$divCuenta[$a];
                                            }
                                            else                                            
                                                break;  
                                        }

                                       

                                    }  
                                
                                endFor;

                                if($vB != $comparar):
                                    $cuenta[$fila]['cuentaPadre']   =  '';
                                    $cuenta[$fila]['error'] = 2; 
                                endIf; // si el valor encontrado es igual al valor buscado

                                 unset($comparar, $divCuenta, $diferencia, $contarVB, $vB);

                            break;
                        default:
                            # code...
                            break;
                    } //termina switch




                endFor;//termina For que recorreo todos el arreglo para buscar la cuenta padre



                unset($nC, $id);

                $error = 0;
                for ($i=2; $i <= $numFilas ; $i++) { 
                    if(!empty($cuenta[$i]['error']) )

                         $error = $error + $cuenta[$i]['error'];
                }

                if($error == 0)
                {
                
                    for($i=2; $i<=$numFilas;$i++)
                    {
                        echo $i;

                     $cC = new Modelos\CuentasContable();

                        $cC->cuenta_contable_id = $cuenta[$i]['id'];
                        $cC->organizacion_id = $id_organizacion;
                        $cC->cuenta = $cuenta[$i]['numCuenta'];
                        $cC->nivel = $cuenta[$i]['nivel'];
                        $cC->nombre = $cuenta[$i]['nombre'];
                        $cC->descripcion = $cuenta[$i]['descripcion'];
                        $cC->subcuenta_de = $cuenta[$i]['cuentaPadre'];
                        $cC->tipo_id = $cuenta[$i]['tipo_id'];
                        $cC->naturaleza = $cuenta[$i]['naturaleza'];
                        $cC->codigo_oficial = $cuenta[$i]['codigoOficial'];
                        $cC->moneda = $cuenta[$i]['moneda'];
                        $cC->numero_cheque = $cuenta[$i]['numeroCheque'];
                        $cC->de_sistema = 1;
                        $cC->pago_permitido = 0;
                        $cC->estado = 1;
                        $cC->modalidad = 'N';

                        if($cC->save())
                        {
                            echo "<br>se guardo fila ".$i;

                        }
                        else
                        {
                            echo 'No se guardo<br>';
                            //print_r($organizacion->getMessages());
                        
                            //Creo un arreglo para que me muestre todos los errores
                            foreach ($cC->getMessages() as $error) 
                            {
                                echo "error: ". $error.'<br>';
                            }
                        }
                    }
               //     return $this->dispatcher->forward(['action'=>'index']);
                    die();
                           
                }
                else
                {
                    $this->view->setVar('numFilas', $numFilas);
                    $this->view->setVar('cuentas', $cuenta);
                    $this->flashSession->error("Existen errores en las cuentas");
                    //$this->flash->warning("Existen errores en las cuentas");
                  //  return $this->dispatcher->forward(["action" => "subirCuenta"]);
                }


            endIf; //endIf si existe el arreglo $cuentas[]  

        } //termina if de recivir post
        else
        {
             return $this->dispatcher->forward(["action" => "index"]);
        }
    }   


}

