<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Proyecto Ingeniería de Software 2 | EPN</title>
  <!-- Favicons-->
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600" rel="stylesheet">

  <!-- BASE CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/vendors.css" rel="stylesheet">

  <!-- YOUR CUSTOM CSS -->
  <link href="css/custom.css" rel="stylesheet">

  <script type="text/javascript">
  function delayedRedirect(){
    window.location = "index.html"
  }
  </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">
<!--<body  style="background-color:#fff;">-->
  <?php
/*Reservar los una habitación por medio de una intefaz web, con los siguientes datos: Fecha de ingreso y salida, tipo de habitación
cantidad de niños y de adultos, requerimientos especiales para la habitación como tipo de alimentación, tipo de privacidad,
servicios extras como bebida de bienvenida, desayuno, cena, retiro del aeropuerto, se debe enviar nombres, apellidos, correo y teléfono para tomar contacto con el cliente
luego de llenar la reserva.
Se puede ver las características de las habitaciones y los datos del hotel
El programa envia un correo de confirmación al cliente y al hotel con los datos ingresados.
Se ingresa los datos a una base de datos para  reportes.

Al programa podrán logearse recepcionita o administrador del hotel para ver las reservas, gestionar habitaciones y ponerse en contacto con el cliente que solicitó la reserva.
El cliente recibirá una notificación que su orden a sido atendida por la recepcionista del hotel y recibirá información extra como el número de la habitación asignada, la hora de ingreso y llegada
permitidas, hora de limpieza, precio final de la reservam incluido requerimientos especiales, y los datos para el depósito bancario a la cuenta del hotel.

Por medio de un link que recibirá al correo electrónico el cliente podrá aceptar los datos enviados por la recepcionista y aceptar para proceder con el método de pago y adjuntar la foto del
del pago bancario.
*/
  include('config/config.php');

  $mail = $_POST['email'];
  $to = "moncayodeibi@gmail.com";/* YOUR EMAIL HERE */
  $subject = "Solicitud de reserva";
  $headers = "From: Hotel Chocolat <noreply@yourdomain.com>";
  $message = "Detalles de la reserva\n";
  $message .= "\nCheck in > Check out: " . $_POST['dates'];
  //echo "Las fechas son".$_POST['dates'];

  $message .= "\nTipo de habitación: " . $_POST['room_type'];
  $message .= "\nAdultos: " . $_POST['adults'];
  $message .= "\nNiños: " . $_POST['child'];
  if( isset( $_POST['notes'] ) && $_POST['notes']) {
    $message .= "\nRequerimientos especiales: " . $_POST['notes'];
  }

  $message .= "\nOpciones Seleccionadas:\n" ;
  foreach($_POST['options'] as $value)
  {
    $message .=   "- " .  trim(stripslashes($value)) . "\n";
  };

  $message .= "\nNombres: " . $_POST['first_name'];
  $message .= "\nApellidos " . $_POST['last_name'];
  $message .= "\nEmail: " . $_POST['email'];
  $message .= "\nTeléfono: " . $_POST['telephone'];
  $message .= "\nTerminos y condiciones: " . $_POST['terms']. "\n";

  //Receive Variable
  $sentOk = mail($to,$subject,$message,$headers);

  //Confirmation page
  $user = "$mail";
  $usersubject = "Reserva Hotel Chocolat";
  $userheaders = "From: programacion@escollanos.com\n";
  /*$usermessage = "Thank you for your time. Your quotation request is successfully submitted.\n"; WITH OUT SUMMARY*/
  //Confirmation page WITH  SUMMARY

  $usermessage = "Gracias por su tiempo. Su requerimiento ha sido enviado.
  Te responderemos cuanto antes.\n\nBELOW A SUMMARY\n\n$message";
  mail($user,$usersubject,$usermessage,$userheaders);


  $sql4 = 'insert into escollan_software2.reservas
        (id,checkin,tipo_cuarto,cantidad_adultos,cantidad_ninos,notas_especiales,nombres, apellidos, email, telefono)
         VALUES (null,'.$_POST['dates'].',"'.$_POST['room_type'].'",
        '.$_POST['adults'].','.$_POST['child'].',"'.$_POST['notes'].'",
        "'.$_POST['first_name'].'","'.$_POST['last_name'].'","'.$_POST['email'].'",'.$_POST['telephone'].'  )';
        //echo $sql4;
        //echo "estoy aaqui";
        $sth4 = FETCH_SQL($sql4);
  ?>
  <!-- END SEND MAIL SCRIPT -->

  <div id="success">
    <div class="icon icon--order-success svg">
      <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
        <g fill="none" stroke="#8EC343" stroke-width="2">
          <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
          <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
        </g>
      </svg>
    </div>
    <h4><span>Su reserva está realizada</span>Gracias por su tiempo</h4>
    <small>Será redirigido en 5 segundos.</small>
  </div>
</body>
</html>
