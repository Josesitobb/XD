<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

/** 
 * La clase `Auth_model` funciona como un modelo en una aplicación web basada en CodeIgniter 
 * y tiene la responsabilidad de gestionar operaciones de base de datos relacionadas 
 * con la autenticación de usuarios.
 * 
 * 1. **Funciones de Verificación de Usuarios:**
 *  - `checkUsername`: 
 *      Verifica si un nombre de usuario existe en la tabla 'user'. 
 *      Comprueba si un nombre de usuario dado coincide con registros existentes y 
 *      devuelve el número de filas coincidentes (0 o 1). Esta función se utiliza 
 *      típicamente para verificar la disponibilidad de un nombre de usuario durante 
 *      el registro de usuarios.
 * 
 * 2. **Función de Recuperación de Contraseña:**
 *  - `getPassword`: 
 *      Recupera la contraseña en formato hash para un nombre de usuario específico. 
 *      Obtiene el hash de contraseña asociado con un nombre de usuario dado en la tabla 'user'. 
 *      Esta función se utiliza durante el proceso de autenticación para comparar el hash 
 *      de contraseña con la entrada del usuario.
 * 
 * 3. **Función de Recuperación de Datos de Usuario:**- `getUserData`: 
 *      Recupera los datos de usuario para un nombre de usuario específico. 
 *      Obtiene todos los datos asociados con un usuario, incluyendo su nombre de usuario, 
 *      en la tabla 'user' y los devuelve como un arreglo. 
 *      Esta función se utiliza para obtener información de usuario con diversos propósitos, 
 *      como mostrar perfiles de usuarios.
 * 
 * En resumen, la clase `Auth_model` desempeña un papel fundamental en la autenticación 
 * de usuarios y la recuperación de datos relacionados con los usuarios dentro de la aplicación. 
 * Abstrae las interacciones con la base de datos relacionadas con la autenticación de usuarios 
 * y proporciona funciones que ayudan a validar las credenciales de usuario, 
 * recuperar información de usuario y llevar a cabo otras tareas relacionadas con la autenticación. 
 * Este modelo desempeña un papel fundamental en garantizar la seguridad y funcionalidad 
 * de los procesos de autenticación de usuarios en la aplicación web.
 */
class Auth_model extends CI_Model
{
    /**
     * Verifica si un nombre de usuario existe en la tabla 'usuario'.
     *
     * @param string $username El nombre de usuario a verificar.
     * @return int El número de filas encontradas (0 o 1).
     */
    public function checkUsername($username)
    {
        $query = $this->db->get_where('user', ['username' => $username]);
        return $query->num_rows();
    }

    /**
     * Obtiene el hash de contraseña para un nombre de usuario específico.
     *
     * @param string $username El nombre de usuario para el que se va a recuperar la contraseña.
     * @return string La contraseña en formato hash.
     */
    public function getPassword($username)
    {
        $data = $this->db->get_where('user', ['username' => $username])->row_array();
        return $data['password'];
    }

    /**
     * Obtiene los datos de usuario para un nombre de usuario específico.
     *
     * @param string $username El nombre de usuario para el que se van a recuperar los datos del usuario.
     * @return array Un array que contiene los datos del usuario.
     */
    public function getUserData($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }
}

