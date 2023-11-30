<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CONFIGURACIÓN DE CONECTIVIDAD A LA BASE DE DATOS
| -------------------------------------------------------------------
| Este archivo contendrá las configuraciones necesarias para acceder a su base de datos.
|
| Para obtener instrucciones completas, consulte la página 'Conexión a la Base de Datos'
| en la Guía del Usuario.
|
| -------------------------------------------------------------------
| EXPLICACIÓN DE LAS VARIABLES
| -------------------------------------------------------------------
|
|	['dsn']      La cadena completa del DSN describe una conexión a la base de datos.
|	['hostname'] El nombre de host de su servidor de base de datos.
|	['username'] El nombre de usuario utilizado para conectarse a la base de datos.
|	['password'] La contraseña utilizada para conectarse a la base de datos.
|	['database'] El nombre de la base de datos a la que desea conectarse.
|	['dbdriver'] El controlador de la base de datos. Ejemplo: mysqli.
|			Actualmente admitidos:
|				cubrid, ibase, mssql, mysql, mysqli, oci8,
|				odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|	['dbprefix'] Puede agregar un prefijo opcional, que se agregará
|				 al nombre de la tabla al usar la clase Query Builder.
|	['pconnect'] TRUE/FALSE: si se debe usar una conexión persistente.
|	['db_debug'] TRUE/FALSE: si se deben mostrar errores de base de datos.
|	['cache_on'] TRUE/FALSE: habilita/deshabilita el almacenamiento en caché de consultas.
|	['cachedir'] La ruta a la carpeta donde se deben almacenar los archivos de caché.
|	['char_set'] El conjunto de caracteres utilizado en la comunicación con la base de datos.
|	['dbcollat'] La colación de caracteres utilizada en la comunicación con la base de datos.
|				 NOTA: Para bases de datos MySQL y MySQLi, esta configuración se usa solo
| 				 como una copia de seguridad si su servidor ejecuta PHP < 5.2.3 o MySQL < 5.0.7
|				 (y en consultas de creación de tablas realizadas con DB Forge).
| 				 Existe una incompatibilidad en PHP con mysql_real_escape_string() que
| 				 puede hacer que su sitio sea vulnerable a la inyección SQL si está utilizando un
| 				 conjunto de caracteres multibyte y está ejecutando versiones inferiores a estas.
| 				 Los sitios que utilizan conjuntos de caracteres y colación de caracteres UTF-8 o Latin-1 no se ven afectados.
|	['swap_pre'] Un prefijo de tabla predeterminado que se debe intercambiar con dbprefix.
|	['encrypt']  Si se debe utilizar o no una conexión encriptada.
|
|			Los controladores 'mysql' (obsoleto), 'sqlsrv' y 'pdo/sqlsrv' aceptan TRUE/FALSE
|			Los controladores 'mysqli' y 'pdo/mysql' aceptan un array con las siguientes opciones:
|
|				'ssl_key'    - Ruta al archivo de clave privada
|				'ssl_cert'   - Ruta al archivo de certificado de clave pública
|				'ssl_ca'     - Ruta al archivo de autoridad de certificación
|				'ssl_capath' - Ruta a un directorio que contiene certificados CA confiables en formato PEM
|				'ssl_cipher' - Lista de cifrados *permitidos* que se utilizarán para el cifrado, separados por dos puntos (':')
|				'ssl_verify' - TRUE/FALSE: si verificar o no el certificado del servidor
|
|	['compress'] Si se debe utilizar o no la compresión del cliente (solo MySQL).
|	['stricton'] TRUE/FALSE: fuerza conexiones en 'Modo Estricto'
|							- útil para garantizar SQL estricto durante el desarrollo.
|	['ssl_options']	Se utiliza para establecer varias opciones SSL que se pueden utilizar al realizar conexiones SSL.
|	['failover'] array: Un array con 0 o más datos para conexiones en caso de que la principal falle.
|	['save_queries'] TRUE/FALSE: si se deben "guardar" todas las consultas ejecutadas.
| 				NOTA: Deshabilitar esto también deshabilitará efectivamente tanto
| 				$this->db->last_query() como el perfil de consultas de la base de datos.
| 				Cuando ejecuta una consulta, con esta configuración en TRUE (predeterminada),
| 				CodeIgniter almacenará la declaración SQL con fines de depuración.
| 				Sin embargo, esto puede causar un alto uso de memoria, especialmente si ejecuta
| 				muchas consultas SQL... desactívelo para evitar ese problema.
*/

$active_group = 'default'; // Especifica el grupo de base de datos activo a utilizar.
$query_builder = TRUE;     // Habilita la clase de base de datos Query Builder.

// La base de datos para el grupo predeterminado
$db['default'] = array(
    'dsn'	    => '',
    
	'hostname'  => 'localhost',	// El nombre de host o dirección IP del servidor de la base de datos.
	'username'  => 'root',      // El nombre de usuario para la conexión a la base de datos.
	'password'  => '',          // La contraseña para la conexión a la base de datos.
	'database'  => 'veico_tools', // El nombre de la base de datos predeterminada.
	
    'dbdriver'  => 'mysqli',
    'dbprefix'  => '',     
    'pconnect'  => FALSE,   
    'db_debug'  => (ENVIRONMENT !== 'production'),
    'cache_on'  => FALSE,       
    'cachedir'  => '',         
    'char_set'  => 'utf8',    
    'dbcollat'  => 'utf8_general_ci',
    'swap_pre'  => '', 
    'encrypt'   => FALSE,      
    'compress'  => FALSE,   
    'stricton'  => FALSE,    
    'failover'  => array(),   
    'save_queries' => TRUE 
);
