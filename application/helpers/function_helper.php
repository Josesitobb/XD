<?php // Done


/*
En CodeIgniter, el directorio application/helpers es un lugar donde puedes
colocar archivos de ayuda personalizados. Los archivos de ayuda contienen
funciones que pueden ayudarte en diversas tareas en tu aplicación.
Estas funciones de ayuda se pueden cargar y utilizar en tus controladores, modelos y vistas.
*/


// Función para verificar si un usuario ha iniciado sesión
function check_login()
{
    // Obtener la instancia de CodeIgniter
    $ci = get_instance();

    // Verificar si 'login_session' existe en los datos de sesión del usuario
    if (!$ci->session->has_userdata('login_session')) {
        // Establecer un mensaje para que el usuario inicie sesión
        set_message('Por favor, inicia sesión', false);
        // Redirigir al usuario a la página de autenticación
        redirect('auth');
    }
}


// Función para verificar si un usuario tiene un rol de 'admin'
function is_admin()
{
    // Obtener la instancia de CodeIgniter
    $ci = get_instance();

    // Obtener el 'rol' de los datos de sesión del usuario
    $role = $ci->session->userdata('login_session')['role'];

    // Inicializar el estado como verdadero
    $status = true;

    // Comprobar si el rol del usuario no es 'admin'
    if ($role != 'admin') {
        // Establecer el estado en falso
        $status = false;
    }

    return $status;
}


// Función para establecer un mensaje para el usuario
function set_message($message, $is_success = true)
{
    // Obtener la instancia de CodeIgniter
    $ci = get_instance();

    // Determinar el tipo de mensaje basado en $is_success
    $message_type = $is_success ? 'Éxito' : 'Error';

    // Generar un identificador único para el mensaje
    $message_id = 'message-' . uniqid();

    // Crear el mensaje con el identificador único y las clases de desvanecimiento
    $message_html = "<div id='$message_id' class='alert alert-" . ($is_success ? 'success' : 'danger') . " fade show'>" .
        "<strong>$message_type!</strong> $message " .
        "<button type='button' class='close' data-dismiss='alert' aria-label='Cerrar'>" .
        "<span aria-hidden='true'>&times;</span></button></div>";

    // Establecer el mensaje flash en los datos de sesión junto con el identificador
    $ci->session->set_flashdata('message', $message_html);
    $ci->session->set_flashdata('message_id', $message_id);
}


// Función para recuperar los datos del usuario de la sesión
function userdata($field)
{
    // Obtener la instancia de CodeIgniter
    $ci = get_instance();

    // Cargar el modelo 'Admin_model'
    $ci->load->model('Admin_model', 'admin');

    // Obtener el ID de usuario de los datos de la sesión
    $userId = $ci->session->userdata('login_session')['user'];

    // Recuperar el campo especificado para el usuario de la tabla 'user'
    return $ci->admin->get('user', ['id_user' => $userId])[$field];
}


// Función para generar datos en formato JSON
function output_json($data)
{
    // Obtener la instancia de CodeIgniter
    $ci = get_instance();

    // Convertir los datos a formato JSON
    $data = json_encode($data);

    // Establecer el tipo de contenido como JSON y generar los datos
    $ci->output->set_content_type('application/json')->set_output($data);
}


// Función para verificar y crear el directorio de Sesiones
function checkSessionDirectory()
{
    // Esta línea construye la ruta al directorio de sesiones dentro de la carpeta 'application'.
    $session_dir = APPPATH . 'sessions';

    // Esta línea verifica si el directorio especificado por $session_dir existe.
    if (!is_dir($session_dir)) {
        // Si el directorio no existe, esta línea crea el directorio 
        // con permisos de lectura, escritura y ejecución para el propietario (0700).
        mkdir($session_dir, 0700);
    }
}


// Función para eliminar archivos de sesiones que sean más antiguos que los segundos especificados
function deleteOldSessionFiles($seconds)
{
    // Define la ruta del directorio de sesiones.
    $session_dir = APPPATH . 'sessions';

    // Verifica si el directorio existe.
    if (is_dir($session_dir)) {
        // Obtiene la marca de tiempo actual.
        $current_time = time();

        // Itera a través de los archivos en el directorio.
        $files = glob($session_dir . '/*');
        foreach ($files as $file) {
            // Verifica si el archivo es un archivo regular y no un directorio.
            if (is_file($file)) {
                // Obtiene la última hora de modificación del archivo.
                $file_time = filemtime($file);

                // Calcula la diferencia de tiempo en segundos.
                $time_diff = $current_time - $file_time;

                // Si el archivo es más antiguo que el tiempo especificado, elimínalo.
                if ($time_diff >= $seconds) {
                    unlink($file); // Elimina el archivo antiguo.
                }
            }
        }
    }
}
