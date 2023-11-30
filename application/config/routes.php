<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| ENRUTAMIENTO DE URI
| -------------------------------------------------------------------------
| Este archivo le permite volver a asignar solicitudes de URI a funciones
| específicas del controlador.
|
| Típicamente, hay una relación uno a uno entre una cadena de URL
| y su respectiva clase/método de controlador. Los segmentos en una
| URL normalmente siguen este patrón:
|
|	ejemplo.com/clase/metodo/id/
|
| Sin embargo, en algunas instancias, es posible que desee volver a asignar esta relación
| para que se llame a una clase/función diferente que la que corresponde a la URL.
|
| Consulte la guía del usuario para obtener detalles completos:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RUTAS RESERVADAS
| -------------------------------------------------------------------------
|
| Hay tres rutas reservadas:
|
|	$route['default_controller'] = 'bienvenido';
|
| Esta ruta indica qué clase de controlador se debe cargar si el
| URI no contiene datos. En el ejemplo anterior, se cargaría la clase "bienvenido".
|
|	$route['404_override'] = 'errores/pagina_faltante';
|
| Esta ruta le dirá al Enrutador qué clase/método utilizar si los
| proporcionados en la URL no pueden coincidir con una ruta válida.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| Esto no es exactamente una ruta, pero le permite enrutar automáticamente
| nombres de controladores y métodos que contienen guiones. '-' no es un carácter válido
| en nombres de clase o método, por lo que requiere traducción.
| Cuando establece esta opción en TRUE, reemplazará TODOS los guiones en los
| segmentos URI del controlador y método.
|
| Ejemplos:	mi-controlador/índice -> mi_controlador/índice
|		mi-controlador/mi-método -> mi_controlador/mi_método
*/

/**
 * Configuración de Enrutamiento
 * 
 * @link        https://codeigniter.com/userguide3/general/routing.html
 * 
 * Este archivo de configuración le permite definir reglas de enrutamiento de URL personalizadas
 * para asignar URL a controladores y métodos específicos en su aplicación CodeIgniter.
 * Las reglas de enrutamiento se pueden usar para crear URL amigables para el usuario.
 *
 *
 * Uso:
 * - '$route['URL'] = 'Controlador/método';' define una regla de enrutamiento para
 *   asignar una URL a un controlador y método específicos.
 * - 'default_controller' establece el controlador predeterminado que se invocará
 *   cuando no se especifique un controlador en la URL.
 * - '404_override' le permite especificar un controlador personalizado para manejar
 *   errores "404 No Encontrado".
 * - 'translate_uri_dashes' controla si los guiones en las URL deben tratarse como guiones bajos
 *   al determinar qué controlador/método llamar.
 *
 * Ejemplo:
 * $route['default_controller'] = 'auth';
 * $route['404_override'] = '';
 * $route['translate_uri_dashes'] = FALSE;
 * $route['login'] = 'auth';
 * $route['logout'] = 'auth/logout';
 * $route['register'] = 'auth/register';
 *
 * En el ejemplo proporcionado:
 * - 'default_controller' se establece en 'auth', por lo que cuando se accede a la URL base,
 *   se invoca el controlador 'auth' de forma predeterminada.
 * - '404_override' está vacío, lo que significa que se utiliza el manejo predeterminado de "404 No Encontrado" de CodeIgniter.
 * - 'translate_uri_dashes' se establece en FALSE, lo que indica que los guiones en las URL
 *   no se traducen a guiones bajos al determinar el controlador/método.
 * - Se definen rutas personalizadas para 'login', 'logout' y 'register', asignando
 *   estas URL a métodos en el controlador 'auth'.
 */

$route['default_controller'] = 'auth'; // Controlador predeterminado cuando no se especifica un controlador
$route['404_override'] = ''; // Controlador personalizado para errores "404 No Encontrado"
$route['translate_uri_dashes'] = FALSE; // Tratar guiones en las URL tal como están
$route['login'] = 'auth'; // Asignar URL 'login' al controlador 'auth'
$route['logout'] = 'auth/logout'; // Asignar URL 'logout' al método 'auth/logout' del controlador
$route['register'] = 'auth/register'; // Asignar URL 'register' al método 'auth/register' del controlador
