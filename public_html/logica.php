<?php

// Iniciar las variables de sesión.
session_start();

// Configuramos la fecha de CDMX
date_default_timezone_set('America/Mexico_City');

// Mostrar esta página solo si se ha enviado un formulario con el verbo POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
  $hoy = date('Y-m-d H:i:s');

  // TODO: Seleccionar la plantilla de correo
  // TODO: Reemplazar los valores de la plantilla por los campos de formulario
  // TODO: Enviar correo or medio de mail()

  // Declaramos una variable de sesión para que la página del formulario
  // pueda mostrar un mensaje de alerta diciendo que se ha enviado favorablemente
  // el formulario de contacto. Después redireccionamos al usuario a la página de
  // formulario. Fin del script.
  $_SESSION['msgAlert'] = true;
  header('Location: /');
  exit;

} else {
  // Si no se muestra esta página por POST entonces mostramos un mensaje de erro.
  exit('Se necesita enviar el formulario para mostrar esta página');
}