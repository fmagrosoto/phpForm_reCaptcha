<?php

// Iniciar las variables de sesión.
session_start();

// Llamar a la librería de reCaptcha, la cual instalamos desde COMPOSER
require("vendor/autoload.php");

// Configuramos la fecha de CDMX
date_default_timezone_set('America/Mexico_City');

// Mostrar esta página solo si se ha enviado un formulario con el verbo POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // reCaptcha
  // Ya que tenemos la librería de reCaptcha, agregamos la clave privada:
  $privada = '6Lcs374ZAAAAAAc-BRapjkB3YTz_UXYhExmdbkxC';
  // Y verificamos que el formulario se haya enviado usando reCaptcha:
  // OJO, las claves que están en este repositorio solo sirven para localhost (y esta página en Heroku).
  // Por lo que deberás de cambiarlas para tu propio proyecto.

  if($_POST['g-recaptcha-response']){

    // Implementamos la funcionalidad de la librería y verificamos que las dos claves
    // sean válidas y actualizadas:
    $recaptcha = new \ReCaptcha\ReCaptcha($privada);
    $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
      ->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    // Verificamos que el token generado por reCaptcha sea válido
    if($resp->isSuccess())
    {
      // AHORA SÍ... enviamos el correo:

      // Variables sanitizadas que vienen del formulario.
      // La seguridad primero 🦾
      // OJO FILTER_FLAG_STRIP_LOW permite acentos y caracteres especiales,
      // FILTER_FLAG_STRIP_HIGH no permite acentos ni caracteres especiales.
      // @see https://www.php.net/manual/es/filter.filters.sanitize.php
      $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
      $apellidoP = filter_input(INPUT_POST, 'apellidoP', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
      $apellidoM = filter_input(INPUT_POST, 'apellidoM', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
      $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
      $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
      $empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
      $comentarios = filter_input(INPUT_POST, 'comentarios', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
      $hoy = date('Y-m-d H:i:s');

      // SELECCIONAR LA PLANTILLA PARA EL CORREO:
      // Puedes hacer una plantilla en HTML para enviar los campos recibidos desde el formulario.
      // Puede ser el diseño que quieras, solo ten en cuenta que debe de llevar algunas cadenas que vamos a usar como
      // variables PHP, por ejemplo {{nombre}}, {{apellidoP}}, etc. Luego, estas cadenas las vamos a reemplazar con los
      // valores de los campos del formulario. Pero primero, debemos de pasar la plantilla como una variable (cadena de texto).
      // Eso se hace así...
      $plantilla = file_get_contents('plantilla_correo.html');

      // Una vez que ha quedado convertida nuestra plantilla en variable, vamos a crear un arreglo con todas las cadenas
      // de texto que queramos ocupar como variables. Ten en cuenta que deben de estar en el mismo orden que están mostradas
      // en el archivo de la plantilla (plantilla_correo.html).
      $variables = [
        '{{nombre}}',
        '{{apellidoP}}',
        '{{apellidoM}}',
        '{{correo}}',
        '{{telefono}}',
        '{{empresa}}',
        '{{comentarios}}',
        '{{fecha}}'
      ];

      // ¡¡Bien!! Ahora vamos a crear otro arreglo con los valores a reemplazar.
      // OJO, toma en cuenta que deben de ir en el mismo orden que el arreglo anterior.
      $valores = [
        $nombre,
        $apellidoP,
        $apellidoM,
        $correo,
        $telefono,
        $empresa,
        $comentarios,
        $hoy
      ];

      // Entonces, ya tenemos la plantilla, las variables y los valores...
      // vamos a reemplazar usando str_replace(), el cual es un método de PHP
      // que requiere de tres parámetros:
      // 1) El arreglo con los nombres de las variables
      // 2) El arreglo con las variables del formulario
      // 3) La cadena de texto donde debe de hacer el reemplazo, en nuestro caso es la plantilla
      // convertida en cadena que hicimos en pasos anteriores con file_get_contents()
      $mensaje = str_replace($variables,$valores,$plantilla);

      // ¡Listo! Tenemos el cuerpo del mensaje del correo electrónico.
      // Ahora, vamos a configurar el envío del correo mediante el método mail() de
      // PHP, fíjate en la configuración siguiente:
      $para = $correo; // Correo a quien le va a llegar el formulario.
      $subject = "Formulario de contacto"; // El ASUNTO del correo.
      $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
      $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
      $cabeceras .= 'From: Webmaster <webmaster@fmagrosoto.com>' . "\r\n"; // El correo del remitente
      mail($para, $subject, $mensaje, $cabeceras); // Enviamos el correo

      // Toma en cuenta los distintos parámetros que necesita mail().
      // Ojo a la concatenación de las cabeceras.
      // @see https://www.php.net/manual/es/function.mail.php

      // Además, toma nota que mail() es una función sencilla para enviar correos a través de PHP.
      // Es probable que tu proveedor de Hosting compartido tenga habilitada esta función, pero en
      // algunas plataformas de Cloud Storage como Heroku, esta función está deshabilitada.
      // También lo está en localhost, con XAMP no vas a poder enviar el correo. Lo que sí es que
      // tampoco vas a tener un error, por eso te recomiendo probarlo en tu hosting compartido.

      // También puedes hacer uso de algunas clases de tercero para enviar correos usando SMTP.
      // Sirve para mandar correos más complejos y de manera más profesional. Ahí nos vas a tener
      // problemas en ninguna parte. Este proyecto es para ejemplificar el uso de reCaptcha, por eso
      // usé mail(), pero puedes usar cualquier otro método de envío que quieras.
      // La lógica de reCaptcha ss el mismo, en ese sentido no cambia nada.

      // Ya mandamos el correo, ahora toca notificar al usuario que se ha enviado...

      // Declaramos una variable de sesión para que la página del formulario
      // pueda mostrar un mensaje de alerta diciendo que se ha enviado favorablemente
      // el formulario de contacto. Después redireccionamos al usuario a la página de
      // formulario. Fin del script.
      $_SESSION['msgAlert'] = true;
      header('Location: /');
      exit;

    } else {
      // Hay veces que el token generado por reCaptcha con el enamoramiento entre las claves públicas y privadas,
      // no son las correctas, cuando pase eso también lo advertimos:
      header('Location: /?error=reCaptchaNoValido');
      exit;
    }

  } else {
    // Este formulario NO se ha enviado con reCaptcha...
    // entonces regresamos un código de error:
    header('Location: /?error=SinReCaptcha');
    exit;
  }

} else {
  // Si no se muestra esta página por POST entonces mostramos un mensaje de erro.
  exit('Se necesita enviar el formulario para mostrar esta página');
}