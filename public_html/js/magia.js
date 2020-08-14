(() => {
  console.log('formPHP con reCaptcha');

  // Globales
  const miForm = document.getElementById('miForm');
  const btnSubmit = document.querySelector('button[type=submit]')
  const btnCerrarMensaje = document.querySelector('.cerrar-mensaje');


  /**
   * VALIDAR FORMULARIO DE CONTACTO.
   * Y mostrar mensajes de advertencia en los campos requeridos.
   * @author Fernando Magrosoto V. <fmagrosoto@gmail.com>
   * @param {object} elForm El formulario de contacto
   * @param {event} e El evento del form, o sea el submit
   * @copyright 2020 08 13, Fernando Magrosoto V.
   * @licence MIT
   */
  const validarFormulario = (elForm, e) => {
    // Primero, deshabilitamos el botón del submit.
    // Siempre es buena práctica deshabilitar el submit al enviar un
    // formulario, pues así impedimos que haya doble clic involuntario o que el usuario
    // se desespere y haga clic de nueva cuenta.
    btnSubmit.disabled = true;

    // Luego checamos si el formulario tiene todos sus campos válidos.
    // OJO, en el HTML del formulario agregamos un parámetro que se llama novalidate,
    // esto es para evitar las advertencias visuales propias del HTML5.
    // Además, pusimos el atributo required en cada campo que deseemos validar.
    // Revisa también el atributo pattern de los campos email y teléfono.
    if(!elForm.checkValidity()) {
      // Si es inválido, entonces le agregamos al formulario la clase .formulario-invalido
      // para que CSS muestre las advertencias visuales.
      // También habilitamos el botón del submit y hacemos que NO envíe nada a través de
      // e.preventDefault()
      elForm.classList.add('formulario-invalido');
      btnSubmit.disabled = false;
      e.preventDefault();
      return false;
    }
  }

  /**
   * CERRAR EL MENSAJE DE ALERTA.
   * Eliminarlo del DOM.
   * @author Fernando Magrosoto V. <fmagrosoto@gmail.com>
   * @param {event} e El evento del ancla, o sea el click
   * @param {object} boton El botón mismo
   * @copyright 2020 08 13, Fernando Magrosoto V.
   * @licence MIT
   */
  const cerrarAlerta = (e, boton) => {
    // Evitamos la acción por default del ancla
    e.preventDefault();

    // Y borramos al papá del papá del botón. 😱
    boton.parentElement.parentElement.remove();
  }


  // Listener para el evento submit 🦻🏼
  if(miForm) {
    miForm.addEventListener('submit', (e) => {
      validarFormulario(miForm, e);
    }, false)
  }

  // Listener para botón de eliminar mensaje de alerta 🦻🏼
  if(btnCerrarMensaje) {
    btnCerrarMensaje.addEventListener('click', (e) => {
      cerrarAlerta(e, btnCerrarMensaje);
    }, false)
  }
})();