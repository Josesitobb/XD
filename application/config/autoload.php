<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CARGA AUTOMÁTICA
| -------------------------------------------------------------------
| Este archivo especifica qué sistemas deben cargarse por defecto.
|
| Con el fin de mantener el framework lo más liviano posible, solo se
| cargan los recursos absolutamente mínimos de forma predeterminada.
| Por ejemplo, la base de datos no se conecta automáticamente, ya que
| no se hace suposición alguna sobre si tiene la intención de usarla.
| Este archivo le permite definir globalmente qué sistemas desea cargar
| con cada solicitud.
|
| -------------------------------------------------------------------
| Instrucciones
| -------------------------------------------------------------------
|
| Estas son las cosas que puede cargar automáticamente:
|
| 1. Paquetes
| 2. Bibliotecas
| 3. Controladores (Drivers)
| 4. Archivos de ayuda (Helpers)
| 5. Archivos de configuración personalizados
| 6. Archivos de idioma (Language)
| 7. Modelos
|
*/


/**
 * Configuración de Carga Automática de Bibliotecas
 * @link        https://codeigniter.com/userguide3/general/autoloader.html
 *
 * Esta configuración le permite especificar qué bibliotecas se deben
 * cargar automáticamente cuando se inicializa su aplicación CodeIgniter.
 * Las bibliotecas son componentes de código reutilizables que proporcionan
 * diversas funcionalidades a su aplicación, como el manejo de bases de datos,
 * sesiones y más.
 *
 *
 * Uso:
 * Para cargar automáticamente una biblioteca, agregue su nombre al arreglo $autoload['libraries'].
 * También puede asignar un nombre de biblioteca alternativo para usar en controladores.
 *
 * Al cargar bibliotecas, pone su funcionalidad a disposición
 * para su uso en controladores, modelos y vistas sin necesidad
 * de cargarlas manualmente.
 */

$autoload['libraries'] = array(
    'database',   // Carga automática de la biblioteca 'database' para operaciones de base de datos
    'session',    // Carga automática de la biblioteca 'session' para gestionar sesiones de usuario
    'cart',       // Carga automática de la biblioteca 'cart' para gestionar el carrito de compras
    'template'    // Carga automática de la biblioteca personalizada 'template' para cargar vistas de plantillas
);

/**
 * Configuración de Carga Automática de Archivos de Ayuda (Helpers)
 * @link        https://codeigniter.com/userguide3/general/autoloader.html
 *
 * Esta configuración le permite especificar qué archivos de ayuda (helpers) deben
 * cargarse automáticamente cuando se inicializa su aplicación CodeIgniter.
 * Los archivos de ayuda contienen funciones que pueden ayudarlo en varias tareas,
 * como generar URL, trabajar con archivos y mejorar la seguridad.
 *
 *
 * Uso:
 * Para cargar automáticamente un archivo de ayuda (helper), agregue su nombre al arreglo $autoload['helper'].
 *
 * La carga automática de archivos de ayuda (helpers) pone sus funciones a disposición
 * para su uso en controladores, modelos y vistas sin necesidad de cargarlos manualmente.
 */

$autoload['helper'] = array(
    'url',             // Carga automática del helper URL para funciones relacionadas con URL
    'file',            // Carga automática del helper File para funciones relacionadas con archivos
    'form',            // Carga automática del helper Form para generación de formularios
    'function_helper', // Carga automática del helper personalizado 'function_helper'
    'security'         // Carga automática del helper Security para funciones relacionadas con la seguridad
);



// Sin modificaciones:


/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();
/*
Auto-load Packages
In CodeIgniter, you can configure the auto-loading of packages using the $autoload array. 
Packages are essentially sets of libraries or components that can be included and utilized
 throughout your application. 
 
 The packages key within the $autoload array is used to specify which packages should be 
 automatically loaded when your application starts.


*/

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|	$autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array();
/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();
/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();
/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/
$autoload['model'] = array();
