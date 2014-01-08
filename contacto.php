<?php
  //Recuperar los datos que serviran para enviar el correo
  $seEnvio;      //Para determinar si se envio o no el correo
  $destinatario = 'ricardo.rodriguez@caler.com.mx';        //A quien se envia
  $elmensaje = str_replace("\n.", "\n..", $_POST['elmsg']);     //por si el mensaje empieza con un punto ponerle 2
  $elmensaje = wordwrap($elmensaje, 80);                       //dividir el mensaje en trozos de 80 cols
  //Recupear el asunto
  $asunto = $_POST['asunt'];
  //Recuperar el curso
  $curso = $_POST['curso'];
  //Formatear un poco el texto que escribio el usuario (asunto) en la caja
  //de comentario con ayuda de HTML
  $cuerpomsg ='
    <html>
    <head>
      <title>Contacto</title>
    </head>
    <body>
      <p>Hola tienes un mensaje en caler.com.mx</p>
      <p> Con referencia al curso '.$curso.'</p>
      <table>
        <tr>
          <td><b>El mensaje que se dejo dice:</b><br></td>
        </tr>
        <tr>
          <td>'.$elmensaje.'</td>
        </tr>
        <tr>
          <td><br></td>
        </tr>
      </table>
    </body>
    </html>
     ';
//Establecer cabeceras para la funcion mail()
    //version MIME
    $cabeceras = "MIME-Version: 1.0\r\n";
    //Tipo de info
    $cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //direccion del remitente
    $cabeceras .= "From: ".$_POST['nombr']." <".$_POST['elcorreo'].">";
    if(mail($destinatario,$asunto,$cuerpomsg,$cabeceras))
        $seEnvio = true;
    else
        $seEnvio = false;
 
//Enviar el estado del envio (por metodo GET ) y redirigir navegador al archivo index.php
        if($seEnvio == true)
    {
        header('Location: contacto.html?estado=enviado');
    }
    else
    {
        header('Location: contacto.html?estado=no_enviado');
    }
?>