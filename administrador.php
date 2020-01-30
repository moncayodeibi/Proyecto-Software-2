<?php

//include("config/config.php");
include("data/login_data.php"); 

$sql1 = 'select * from escollan_software2.admin where username = "'.$_SESSION['login_user'].'"'; 
//echo $sql1 . "<br>";
$sth1=FETCH_SQL($sql1);
while($result1 = $sth1->fetch(PDO::FETCH_OBJ)){
  $rol=$result1->rol;
  $nombres_usuario=$result1->nombres;
}

$contador=0;
$tabla = '<table class="table table-hover">
<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Email</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Adultos</th>
        <th scope="col">Niños</th>
        <th scope="col">Tipo Cuarto</th>
        <th scope="col">Notas</th>
        <th scope="col">Extras</th>
    </tr>
</thead>
    <tbody>';
/* Gaby */
	///////////////////////////////////////////////////////////////////////lista de planificación de médicos ingresados//////////////////////////////////////////////////////////////
	$sql3 = "select * from reservas";
//  
	//echo $sql3;
	$sth3=FETCH_SQL($sql3);
	while($result3 = $sth3->fetch(PDO::FETCH_OBJ)){
        $contador=$contador+1;
        $id=$result3->id;
        $nombres=$result3->nombres;
        $apellidos=$result3->apellidos;
        $email=$result3->email;
        $telefono=$result3->telefono;
        $cantidad_adultos=$result3->cantidad_adultos;
        $cantidad_ninos=$result3->cantidad_ninos;
        $tipo_cuarto=$result3->tipo_cuarto;
        $notas_especiales=$result3->notas_especiales;
        $opciones=$result3->opciones;
        $estado=$result3->estado;

        if ($estado==0) {
            $estado="danger";
        }
        elseif($estado==0){
            $estado="light";
        }

        if ($tipo_cuarto=="Sencilla Clasica") {
            $precio=110;
        }
        elseif($tipo_cuarto=="Sencilla Luxury"){
            $precio=180;
        }
        elseif($tipo_cuarto=="Doble Clasica"){
            $precio=150;
        }
        elseif($tipo_cuarto=="Doble Luxury"){
            $precio=190;
        }     
	$tabla .= '
    <tr class="table-'.$estado.'">
        <th scope="row">'.$contador.'</th>
        <td>'.$nombres.'</td>
        <td>'.$apellidos.'</td>
        <td>
            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal'.$id.'">
            '.$email.' 
            </button>        
        </td>
        <td>'.$telefono.'</td>
        <td>'.$cantidad_adultos.'</td>
        <td>'.$cantidad_ninos.'</td>
        <td>'.$tipo_cuarto.'</td>
        <td>'.$notas_especiales.'</td>
        <td>'.$opciones.'</td>
    </tr>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmación Reserva: '.$nombres.' '.$apellidos.' </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  method="post" action="respuesta.php">  
                <div class="modal-body">                          
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Seleccione el número de la habitación <b>'.$tipo_cuarto.'</b>: </label>
                            <select class="form-control" id="exampleFormControlSelect1" name="habitacion" >
                                <option>101</option>
                                <option>201</option>
                                <option>301</option>
                                <option>401</option>
                                <option>501</option>
                            </select>
                        </div> 
                        <label><b>Precio</b>: </label>
                        <input type="text" name="precio" class="form-control required" placeholder="Username" value="'.$precio.'">   
                        <label><b>Cooreo de Confirmación</b>: </label>
                        <input type="text" name="email" class="form-control required" placeholder="Username" value="'.$email.'"> 
                        <input type="hidden" name="id" class="form-control required" placeholder="Username" value="'.$id.'">                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar Confirmación</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    ';
			
	}
  $tabla .=  '</tbody></table>';

 

$html = file_get_contents("administrador.html");
$html = str_replace("{tabla}",$tabla,$html);

$html = str_replace("{rol}",$rol,$html);
$html = str_replace("{nombres_usuario}",$nombres_usuario,$html);



echo $html;
?>
