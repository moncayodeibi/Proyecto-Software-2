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
    window.location = "administrador.php"
  }
  </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">

<!--
<pre>

</pre>
-->

  <?php

  include('config/config.php');

  $mail = $_POST['email'];
  $precio = $_POST['precio'];
  $habitacion = $_POST['habitacion'];
  $id = $_POST['id'];
  
  $to = "moncayodeibi@gmail.com";/* YOUR EMAIL HERE */
  $subject = "Cofirmación de reserva";
  $headers = "From: Hotel Chocolat <noreply@hotelchocolate.com>";
  $message = "Reserva Confirmada \n";
  $message .= "
                \n Habitación:  $habitacion
                \n Precio:  $precio
                \n Transferencia a los datos:
                \n Banco EPN 
                \n Cuenta de Ahorros: 123456789
                \n A nombre de Estudiantes de Software 2";             


  //echo "Las fechas son".$_POST['dates'];

  //Receive Variable
  $sentOk = mail($to,$subject,$message,$headers);

  //Confirmation page
  $user = "$mail";
  $usersubject = "Confirmación Reserva Hotel Chocolat";
  $userheaders = "From: moncayodeibi@gmail.com\n";
  /*$usermessage = "Thank you for your time.
  
  Your quotation request is successfully submitted.\n"; WITH OUT SUMMARY*/
  //Confirmation page WITH  SUMMARY

  $usermessage = "Gracias por su tiempo. Reserva confirmada.\n\nRESUMEN\n\n$message";
  mail($user,$usersubject,$usermessage,$userheaders);


  $sql4 = 'UPDATE reservas SET estado = 1 WHERE id='.$id.'';
        echo $sql4;
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
    <h4><span>Mensaje enviado con éxito</span></h4>
    <small>Será redirigido en 5 segundos.</small>
  </div>
</body>
</html>
