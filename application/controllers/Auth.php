<?php // Done.
/*
defined('BASEPATH') or exit('No direct script access allowed');

Asegura que el script PHP solo pueda ejecutarse en el contexto de una aplicación CodeIgniter. 
Si alguien intenta acceder al script directamente ingresando su URL en un navegador, 
verá el mensaje 'No se permite acceso directo al script' y el script no se ejecutará.

Esta es una característica de seguridad diseñada para proteger las partes sensibles 
de tu aplicación contra accesos no autorizados y se utiliza comúnmente en CodeIgniter 
y muchos otros frameworks de PHP.
*/
defined('BASEPATH') or exit('No direct script access allowed');


// Define una clase llamada Auth que sirve como controlador en una aplicación CodeIgniter
// y hereda funcionalidad de la clase base CI_Controller.
class Auth extends CI_Controller // Autenticación
{

    // El constructor del controlador
    public function __construct()
    {
        parent::__construct();
        // Cargar la biblioteca de validación de formularios para la validación de entradas.
        $this->load->library('form_validation');
        // Cargar el modelo de autenticación como 'auth'.
        $this->load->model('Auth_model', 'auth');
        // Cargar el modelo de administrador como 'admin'.
        $this->load->model('Admin_model', 'admin');

        // Verificar y crear el directorio de sesiones si no existe
        checkSessionDirectory();
        // Eliminar sesiones más antiguas de 24 horas (en segundos)
        deleteOldSessionFiles(86400);
    }


    // Verificar si el usuario ya ha iniciado sesión y redirigir al panel de control si está conectado.
    private function _checkLoggedIn()
    {
        // Comprobar si existe una sesión de usuario llamada 'login_session'.
        if ($this->session->has_userdata('login_session')) {
            // Redirigir al usuario al panel de control.
            redirect('dashboard');
        }
    }


    /**
     * Realiza la gestión del inicio de sesión de usuario.
     *
     * Verifica si el usuario ya está conectado y, si no lo está,
     * procesa el formulario de inicio de sesión, incluyendo la validación
     * de las credenciales y la gestión de la sesión del usuario.
     */
    public function index()
    {
        // Verificar si el usuario ya está conectado.
        $this->_checkLoggedIn();

        // Establecer reglas de validación para el formulario de inicio de sesión.
        $this->form_validation->set_rules('username', 'Username', 'required|trim'); // Nombre de usario
        $this->form_validation->set_rules('password', 'Password', 'required|trim'); // Contraseña

        // Comprobar si la validación del formulario no pasó (es decir, la validación falla).
        if ($this->form_validation->run() == false) {
            // Si la validación del formulario falla, cargar la vista del formulario de inicio de sesión.
            $data['title'] = 'Iniciar sesión';
            $this->template->load('templates/auth', 'auth/login', $data);
        } else {
            // Obtener de manera segura la entrada del formulario enviada y almacenarla en $input.
            $input = $this->input->post(null, true);

            // Comprobar si el nombre de usuario existe en la base de datos.
            $usernameExists = $this->auth->checkUsername($input['username']);

            // Si el nombre de usuario existe en la base de datos.
            if ($usernameExists > 0) {
                // Recuperar el hash de contraseña almacenado para el nombre de usuario.
                $passwordHash = $this->auth->getPassword($input['username']);

                // Verificar la contraseña ingresada con el hash de contraseña almacenado.
                if (password_verify($input['password'], $passwordHash)) {
                    // Recuperar los datos del usuario de la base de datos según el nombre de usuario.
                    $userDbData = $this->auth->getUserData($input['username']);

                    // Comprobar si la cuenta del usuario está activa.
                    if ($userDbData['is_active'] != 1) {
                        // Mostrar un mensaje de error si la cuenta no está activa.
                        set_message('Por favor, póngase en contacto con el administrador para activar su cuenta', true);
                        // Redirigir al usuario a la página de inicio de sesión.
                        redirect('login');
                    } else {
                        // Crear un arreglo con los datos de la sesión del usuario.
                        $userData = [
                            'user'      => $userDbData['id_user'],
                            'role'      => $userDbData['role'],
                            'timestamp' => time(),
                        ];

                        // Establecer los datos de la sesión del usuario para el inicio de sesión.
                        $this->session->set_userdata('login_session', $userData);
                        // Redirigir al usuario al panel de control.
                        redirect('dashboard');
                    }
                } else {
                    // Mostrar un mensaje de error para contraseña incorrecta.
                    set_message('Contraseña incorrecta', false);
                    // Redirigir al usuario a la página de autenticación.
                    redirect('auth');
                }
            } else {
                // Mostrar un mensaje de error para un nombre de usuario que no existe.
                set_message('Nombre de usuario no registrado', false);
                // Redirigir al usuario a la página de autenticación.
                redirect('auth');
            }
        }
    }


    /**
     * Realiza la acción de cerrar sesión de usuario.
     *
     * Destruye la sesión del usuario para cerrar la sesión actual,
     * muestra un mensaje de éxito al cerrar sesión y redirige al usuario
     * a la página de autenticación.
     */
    public function logout()
    {
        // Destruir la sesión del usuario para cerrar sesión.
        $this->session->unset_userdata('login_session');
        // Mostrar un mensaje de éxito al cerrar sesión.
        set_message('¡Cierre de sesión exitoso!', true);
        // Redirigir al usuario a la página de autenticación.
        redirect('auth');
    }


    /**
     * Realiza la acción de registro de usuario.
     *
     * Establece reglas de validación para el formulario de registro,
     * procesa los datos enviados por el usuario, realiza el hash de la contraseña
     * para un almacenamiento seguro, y guarda los datos del usuario en la base de datos.
     * Se muestra un mensaje de éxito y se redirige al usuario a la página de inicio de sesión
     * si el registro es exitoso, o se muestra un mensaje de error y se redirige de nuevo
     * a la página de registro en caso de fallo.
     */
    public function register()
    {
        // Establecer reglas de validación para el formulario de registro.

        // Definir reglas para el campo 'username' (nombre de usario): es requerido, 
        // se recorta, debe ser único en la tabla 'user' y contener solo caracteres alfanuméricos.
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|alpha_numeric');

        // Definir reglas para el campo 'password' (contraseña): es requerido, 
        // debe tener una longitud mínima de 3 caracteres y se recorta.
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');

        // Definir reglas para el campo 'password2': debe coincidir con el campo 'password' y se recorta.
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]|trim');

        // Definir reglas para el campo 'name' (nombre): es requerido y se recorta.
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        // Definir reglas para el campo 'email': es requerido, se recorta, 
        // debe tener un formato de correo electrónico válido y debe ser único en la tabla 'user'.
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');

        // Definir reglas para el campo 'phone_number' (número de teléfono): es requerido y se recorta.
        $this->form_validation->set_rules('phone_number', 'Phone number', 'required|trim');


        if ($this->form_validation->run() == false) {
            // Si la validación del formulario falla, cargar la vista del formulario de registro.
            $data['title'] = 'Crear Cuenta';
            $this->template->load('templates/auth', 'auth/register', $data);
        } else {
            // Obtener de manera segura los datos del formulario y almacenarlos en $input
            $input = $this->input->post(null, true);
            // Eliminar el campo 'password2' de los datos de entrada
            unset($input['password2']);
            // Hashear la contraseña del usuario para un almacenamiento seguro
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            // Establecer el rol del usuario en 'user' (usario) (puede personalizar esto según sea necesario)
            $input['role'] = 'user';
            // Establecer la imagen de perfil del usuario en 'user.png' (personalizar según sea necesario)
            $input['picture'] = 'user.png';
            // Establecer el estado de la cuenta del usuario en inactivo (puede cambiar esto según su proceso de activación)
            $input['is_active'] = 0;
            // Establecer la marca de tiempo de creación de la cuenta del usuario en el tiempo actual
            $input['created_at'] = time();

            // Insertar los datos del usuario en la base de datos.
            $query = $this->admin->insert('user', $input);

            if ($query) {
                // Mostrar un mensaje de éxito (el administrador debe activar la cuenta).
                set_message('Por favor, póngase en contacto con el administrador para activar su cuenta', true);
                // Redirigir al usuario a la página de inicio de sesión
                redirect('login');
            } else {
                // Mostrar un mensaje de error si falla el registro.
                set_message('¡Oops, Algo salió mal!', false);
                // Redirigir al usuario a la página de registro
                redirect('register');
            }
        }
    }
}
