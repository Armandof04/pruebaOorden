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

    public function uploadCoiAction()
    {
        //comprueba si hay archivos por subir
        if ($this->request->hasFiles() == true) 
        {
            // Print the real file names and sizes
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
                            $this->flash->warning("Formato no compatible, solo se permite &#34;XLS&#34; y &#34;XLSX&#34;");
                            unlink("./excel_files/".$file->getName()); //elimino el archivo
                            return; 
                        }

                        $this->flash->notice("Archivo ".$extension  [1]);
                        $file = './excel_files/' . $file->getName(); //acortamos el nombre y ruta del archivo

                       /** PHPExcel */           
                       //require_once 'PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';   

                   //     include_once '/../../app/vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';

                       
                
                       
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

                            foreach ($cellIterator as $cell) 
                            {
                                      //  echo '<td>'. $cell->getValue() . '</td>' . "\n";
                                    if($celda <=8 && $fila != 1) //En archivos 2007 o superiores detecta celdas null como activas
                                    {  
                                        if($celda == 0)
                                        {
                                            $nivel = explode("-", $cell->getValue());
                                            $arreglo[$fila]['nivel'] = count($nivel);
                                        }   
                                        $arreglo[$fila][]=$cell->getValue();

                                    }
                                $celda +=1;
                            }     
                        }
                        /*
                            Ya tenemos el arreglo con los datos y a cuantos subniveles son, ahora vamos a agregar a que subnivel pertenece
                        */
                        if (!empty($arreglo) && is_array($arreglo)) //si el arreglo no esta vaci0 y si es un arreglo
                        {
                            $numFilas =  count($arreglo);

                            $buscar = $arreglo[21][0];
                            $id = $arreglo[21]['id'];
                            echo "VALOR COMPLETO ". $buscar."<br>"; 
                            echo "id: ".$id;
                            $buscar = explode("-", $buscar);

                            echo '<br>VALOR A BUSCAR = '.$buscar[0];

                            $columna = 0;
                            $contadorRegistros = 0;

                            for ($i=2; $i <= $numFilas; $i++) // creo un ciclo for para pasar por todos los arreglos
                            {
                                $divCuenta = explode("-",$arreglo[$i][$columna]);
                              //  echo "DIVCUENTA ".$divCuenta[0];
                                
                                if ($divCuenta[0]==$buscar[0] || strcmp($divCuenta[0],$buscar[0])==0 )  //ejecuto la busqueda si encuentra algun valor
                                {

                                    $nivelCuenta = $arreglo[$i]['nivel'];

                                    
                                  //  $coincidencias[$contadorRegistros][]    =   $divCuenta[0];

                                    $salto = 0;
                                   // $j=0;

                                   // echo 'nivel ---'.$nivelCuenta;
                                    //

                                    for ($j=0; $j < $nivelCuenta;$j++)
                                    {
                                        //AQUI HAY QUE PONER UN WHILE, YA QUE REPITE EL SIGLO AUN CUANDO EL SUBNIVEL NO CORRESPONDA

                                        if($salto == 0)
                                            $coincidencias[$contadorRegistros]['id']    =   $arreglo[$i]['id'];

                                       if ($divCuenta[$j]==$buscar[$j] || strcmp($divCuenta[$j],$buscar[$j])==0 )  //ejecuto la busqueda si encuentra algun valor
                                        {
                                            //   echo "<br>valor encontrado en fila ".$i." nivel ".$j." se buscarra ahora ".$buscar[$j];
                                                 
                                            //   $coincidencias[$contadorRegistros][]    =   '_'.$divCuenta[$j]."_n=".$j." -";
                                        }
                                        elseif ($divCuenta[$j] == 0) 
                                        {
                                            //    echo "<br>|se queda en nivel ".$i." | nivel ".$j;
                                            
                                                $coincidencias[$contadorRegistros][]    =   '_'.$divCuenta[$j]." ns=".$j."_vB=".$buscar[$j]." -";
                                            
                                                break;
                                        
                                        }
                                        else
                                        {
                                            break;
                                        }
                                        $salto=1;
                                    }

                                    $contadorRegistros++;
                                }

                            }

                            echo "<br>Se encontraron ".$contadorRegistros." registros<br>";

                            if($contadorRegistros >= 2 )
                            {
                                echo "<pre>";
                                var_dump($coincidencias);
                                echo "</pre>";
                              
                                echo "============================";

                                for ($i=0; $i < $contadorRegistros; $i++) { 

                                    $nivelCoincidencias = count($coincidencias[$i]);
                                    $nivelCoincidencias = $nivelCoincidencias-1;
                                   //echo $nivelCoincidencias;

                                    echo '<br>-'.$coincidencias[$i]['id'];

                                   for ($j=0; $j < $nivelCoincidencias; $j++) { 
                                       
                                       echo $coincidencias[$i][$j]  ;

                                    }
                                }
                            }

                            elseif ($contadorRegistros == 1) 
                            {
                                
                            }

                        
                
                            
                        }
                       // echo "<pre>";
                       // var_dump($arreglo);
                       // echo "</pre>";

                    }
                else
                    $this->flash->warning("Error al cargar el archiv  ".$file->getName().". Intente nuevamente");
            }
        }
    }   


}

