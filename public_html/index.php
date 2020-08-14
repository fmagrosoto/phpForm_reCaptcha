<?php
  // Iniciar las variables de sesión.
  session_start();

  // Al enviar el formulario, declaramos una variable de sesión para que nos permita
  // poner un mensaje de alerta y comunicar que el formulario se ha enviado favorablemente.
  if(isset($_SESSION['msgAlert']))
  {
    $msgAlert = true;
    // Borramos la variable de sesión para que ya no aparezca el mensaje después de
    // refrescar la página.
    unset($_SESSION['msgAlert']);
  }
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>phpForm con reCaptcha</title>
  <link rel="stylesheet" href="/css/estilos.css">
  <meta name="author" content="Fernando Magrosoto Vásquez">
  <meta name="description" content="Hacer un formulario con PHP y reCaptcha de Google">
  <meta name="keywords" content="fmagrosoto, php, recaptcha, web developer, github">
  <meta name="robots" content="index,follow">

  <style>
    /* GitHub Ribbon Style */
    .github-corner:hover .octo-arm {
      animation:octocat-wave 560ms ease-in-out
    }

    @keyframes octocat-wave {
      0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}
    }

    @media (max-width:500px) {
      .github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}
    }
  </style>
</head>
<body>
  <!-- GitHub Ribbon Markup -->
  <a target="_blank" href="https://github.com/fmagrosoto/phpForm_reCaptcha"
     class="github-corner"
     aria-label="View source on GitHub">
    <svg width="80" height="80" viewBox="0 0 250 250" style="fill:#151513; color:#fff;
    position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true">
      <path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path>
      <path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path>
      <path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path>
    </svg>
  </a>
  <!-- // ribbon -->

  <header>
    <div class="contenedor">
      <h1>phpForm con módulo reCaptcha de Google</h1>
    </div>
  </header>

  <main>
    <div class="contenedor">
      <h2>Llene el siguiente formulario</h2>

      <?php if(isset($msgAlert)) : ?>
      <div class="mensaje-alerta alerta-ok marriba-2">
        <span>👍🏼</span>
        <span>El formulario se ha enviado favorablemente.</span>
        <span><a href="#" class="cerrar-mensaje">&times;</a></span>
      </div>
      <?php endif; ?>

      <form id="miForm" class="marriba-2" method="POST" action="/logica.php" autocomplete="off" novalidate>
        <fieldset>
          <legend>Formulario de contacto</legend>

          <div class="zona-flex flex-gutter">
            <div class="item-flex-33 bloque-form">
              <label>Nombre(s)</label>
              <input type="text" name="nombre" minlength="4" maxlength="20" required>
              <p class="campo-invalido">⚠️ Introduce tu nombre.</p>
            </div>
            <div class="item-flex-33 bloque-form">
              <label>Apellido paterno</label>
              <input type="text" name="apellidoP" minlength="4" maxlength="20" required>
              <p class="campo-invalido">⚠️ Introduce tu apellido paterno.</p>
            </div>
            <div class="item-flex-33 bloque-form">
              <label>Apellido materno</label>
              <input type="text" name="apellidoM" minlength="4" maxlength="20" required>
              <p class="campo-invalido">⚠️ Introduce tu apellido materno.</p>
            </div>
          </div>

          <div class="zona-flex flex-gutter marriba-1">
            <div class="item-flex-33 bloque-form">
              <label>Correo</label>
              <input type="email" name="correo"
                     pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"  required>
              <p class="campo-invalido">⚠️ Introduce un correo válido.</p>
            </div>
            <div class="item-flex-33 bloque-form">
              <label>Teléfono</label>
              <input type="text" name="telefono" pattern="[0-9]{10}"
                     minlength="10" maxlength="10" required>
              <p class="campo-invalido">⚠️ Teléfono de 10 dígitos.</p>
            </div>
            <div class="item-flex-33 bloque-form">
              <label>Empresa</label>
              <input type="text" name="empresa" minlength="4" maxlength="25" required>
              <p class="campo-invalido">⚠️ Introduce tu empresa.</p>
            </div>
          </div>

          <div class="bloque-form marriba-1">
            <label>Comentarios</label>
            <textarea name="comentarios" minlength="5" maxlength="255" required
                      style="height: 6rem; resize: none"></textarea>
            <p class="campo-invalido">⚠️ Tus comentarios son importantes.</p>
          </div>

          <hr>

          <div class="zona-flex flex-centrado bloque-form">
            <div class="item-flex-33 bloque-form">
              <button type="submit" class="boton-bloque">
                Enviar formulario
              </button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </main>

  <footer>
    <div class="contenedor">
      <div class="zona-flex flex-centrado">
        <div class="item-flex-33">
          <h4>phpForm con reCaptcha de Google</h4>
          <p>&copy;2020 - Fernando Magrosoto Vásquez</p>
          <p>Todos los Derechos Reservados</p>
          <p>
            <a target="_blank" href="https://github.com/fmagrosoto/phpForm_reCaptcha">
              [ Haz un fork en GitHub ]
            </a>
          </p>
          <p class="marriba-1" style="text-align: center">
            <a target="_blank" href="https://validator.w3.org/">
              <img src="https://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png"
                   width="165" height="64"
                   alt="HTML5 Powered with CSS3 / Styling, and Semantics"
                   title="HTML5 Powered with CSS3 / Styling, and Semantics">
            </a>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script src="/js/magia.js"></script>
</body>
</html>