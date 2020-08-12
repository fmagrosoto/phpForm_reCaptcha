# PHPFORM_RECAPTCHA

![GitHub repo size](https://img.shields.io/github/repo-size/fmagrosoto/phpForm_reCaptcha)
![GitHub contributors](https://img.shields.io/github/contributors/fmagrosoto/phpForm_reCaptcha)
![GitHub stars](https://img.shields.io/github/stars/fmagrosoto/phpForm_reCaptcha)
![GitHub forks](https://img.shields.io/github/forks/fmagrosoto/phpForm_reCaptcha)
![Twitter Follow](https://img.shields.io/twitter/follow/fmagrosoto?style=social)

***
![Packagist](https://img.shields.io/badge/Stack-Lamp-yellowgreen.svg)
![Packagist](https://img.shields.io/badge/PHP-7.3.*-yellowgreen.svg)
![Packagist](https://img.shields.io/badge/License-MIT-lightgrey.svg)

[![JavaScript Style Guide](https://cdn.rawgit.com/standard/standard/master/badge.svg)](https://github.com/standard/standard)
***

Creación de un formulario de contacto usando [FormPHP](https://github.com/fmagrosoto/formPHP) con
[Google reCaptcha](https://www.google.com/recaptcha/about/) para prevenir bots.

La idea es hacer un formulario de contacto (u otros similares) donde queramos que los campos enviados
nos lleguen por correo electrónico. Pero con la adición de un Sistema Captcha donde prevengamos
el envío de este formulario por BOTS. Esto hace que nos llegue el formulario incompleto o lleno
de publicidad engañosa. Para unos clientes (y personas en general), esto es fastidioso y muy molesto.

Por eso me atreví a crear este repo para facilitar el uso de **reCaptcha**, un sistema Captcha creado
por **Google**. Es muy fácil de implementar y nos previene de manera efectiva de los molestos BOTS.

## PROYECTO

* Historia: agosto, 2020
* Autor: Fernando Magrosoto V.
* Stack de desarrollo: PHP, HTML, Javascript, CSS
* Frameworks: no

## PREREQUISITOS

Necesitas un **servidor web** con un intérprete de **PHP** para que puedas ver en vivo el funcionamiento
del código. Si no tienes instalado **Apache** y **PHP** en tu equipo, puedes instalar
[XAMPP](https://www.apachefriends.org/es/index.html), que es un extraordinario servidor web,
indispensable para tu ambiente de desarrollo.

Y por supuesto, un buen editor de código... no hay de otra: **Visual Studio Code** o **PHPStorm**.

## INSTALAR PHPFORM_RECAPTCHA

No hay nada que instalar, todo lo que necesitas usar está dentro de la carpeta ```public_html```.

Sin embargo, es buena práctica usar **COMPOSER** para instalar dependencias de desarrollo.

**Google reCaptcha** pone a disposición un pequeño framework para poder configurarlo en un ambiente **PHP**.
Esta dependencia se encuentra en **COMPOSER**. Revisar el archivo ```composer.json``` que se encuentra
en el directorio raíz *(donde se encuentra este archivo que estás leyendo)* para que veas cómo se instala
esta dependencia. **OJO** toma en cuenta que cuando usas **COMPOSER**, este te crea una carpeta llamada
```vendor```, esta carpeta se debe de subir a tu ambiente de producción. Generalmente la instala en el
mismo nivel donde se encuentra ```composer.json```, pero nosotros separamos la carpeta pública, es por
eso que en ```composer.json``` configuramos que la carpeta ```vendor``` se instale dentro de
```public_html``` y no en la raíz. Tómalo en cuenta a la hora de crear tu estructura de archivos en
tu proyecto (*scaffolding*).

## USANDO PHPFORM_RECAPTCHA

En cada archivo PHP o Javascript, se encuentra la explicación del código y la forma para que
puedas customizarlo a tu propio proyecto.

### EN AMBIENTE DE PRODUCCIÓN

Solo sube el contenido de la carpeta ```public_html``` a la carpeta pública de tu servidor de hosting.
Regularmente se llama igual: ```public_html``` o a veces ```www```. Todo lo que está afuera de esta
carpeta solo es para el entorno de desarrollo, no lo necesitas en producción.

### EN AMBIENTE DE DESARROLLO

Apunta XAMP (o tu servidor web) al index.html de ```public_html```. Te recomiendo que lo hagas
usando subdominios.

Por ejemplo, si usas subdominios, configura ```phpform.localhost``` como tu subdominio y apunta al
```index.html``` dentro de la carpeta ```public_html```. **No apuntes hacia la carpeta del proyecto**.

> Cada archivo PHP o Javascript dentro de ```public_html``` se encuentra debidamente comentado y documentado.
> No se te olvide echarles un ojo. Ahí podrás darte cuenta el **qué** y el **porqué** del código, que es lo
> más importante de este proyecto.

## CONTRIBUIR A PHPFORM_RECAPTCHA

Si estás interesado en contribuir en este Repo, entonces puedes hacer un FORK desde mi rama ```develop```;
depura y modifica el código y haz un PR (Pull Request) a la rama ```develop```. Yo lo reviso y lo
integro.

## CONTACTO

Si no entendiste nada de lo mencionado o tienes algunas otras dudas, entonces me puedes contactar
a mi correo [fmagrosoto@gmail.com](fmagrosoto@gmail.com) o únete a mi [Twitter](https://twitter.com/fmagrosoto).

También me puedes contactar desde [GitHub](https://github.com/fmagrosoto).

Happy Coding...🍻

## LICENCIA

Este proyecto usa la siguiente licencia: [LICENSE](LICENSE)