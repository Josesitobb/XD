<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller // Perfil
{
    protected $user; // El usuario de la sesión

    public function __construct()
    {
        parent::__construct();

        // Verificar si el usuario ya está conectado.
        // Redirigir al usuario a la página de autenticación si no esta conectado.
        check_login();

        // Cargar el modelo de administrador como 'admin'.
        $this->load->model('Admin_model', 'admin');
        // Carga la biblioteca 'form_validation'.
        $this->load->library('form_validation');

        // Obtener el ID del usuario de la sesión y obtener los datos del usuario.
        $userId = $this->session->userdata('login_session')['user'];
        $this->user = $this->admin->get('user', ['id_user' => $userId]);
    }


    /**
     * Muestra la página de perfil del usuario.
     */
    public function index()
    {
        // Establecer el título para la página de perfil.
        $data['title'] = "Perfil";

        // Obtener los datos del usuario y asignarlos a la clave 'user' en el arreglo de datos.
        $data['user'] = $this->user;

        // Cargar la vista 'user' con el arreglo de datos en la plantilla 'dashboard'.
        $this->template->load('templates/dashboard', 'profile/user', $data);
    }


    /**
     * Realiza la validación antes de realizar una actualización en la base de datos.
     */
    private function _validate()
    {
        // Obtener el ID de usuario del arreglo de datos del usuario.
        $id_user = $this->user['id_user'];

        // Verificar si el ID de usuario está definido en los datos del usuario.
        if (!isset($id_user)) {
            // Establecer un mensaje de éxito y redirigir a la página de 'editar'
            set_message('¡Oops, Algo salió mal!', false);
            redirect('profile/edit');
            // return;
        }

        // Consultar la base de datos para obtener los datos del usuario.
        $db = $this->admin->get('user', ['id_user' => $id_user]);

        // Si no se encuentra al usuario en la base de datos, mostrar un mensaje de error.
        if (empty($db)) {
            // Establecer un mensaje de éxito y redirigir a la página de 'editar'
            set_message('¡Oops, Algo salió mal!', false);
            redirect('profile/edit');
            // return;
        }

        // Obtener los valores de 'username' y 'email' desde la entrada de formulario, asegurando que sean seguros.
        $username = $this->input->post('username', true);
        $email = $this->input->post('email', true);

        // Determinar si 'username' y 'email' son únicos en comparación con los valores en la base de datos.
        $uniqueUsername = $db['username'] == $username ? '' : '|is_unique[user.username]';
        $uniqueEmail = $db['email'] == $email ? '' : '|is_unique[user.email]';

        // Configurar las reglas de validación del formulario para el campo 'username'.
        $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric' . $uniqueUsername);

        // Configurar las reglas de validación del formulario para el campo 'email'.
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $uniqueEmail);

        // Configurar las reglas de validación del formulario para el campo 'name'.
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        // Configurar las reglas de validación del formulario para el campo 'phone_number'.
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|numeric');
    }


    /**
     * Configura las opciones de carga de archivos para la subida de imágenes de perfil.
     */
    private function _configureUpload()
    {
        // Configuración de opciones para la carga de archivos.
        $config['upload_path'] = "./assets/img/avatar"; // Define la ruta de carga para las imágenes de perfil.
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Define los tipos de archivos permitidos (formatos de imagen).
        $config['encrypt_name'] = TRUE; // Habilita la encriptación del nombre del archivo cargado por seguridad.
        $config['max_size'] = '5000'; // Establece el tamaño máximo del archivo en kilobytes (5 MB en este caso).

        // Carga la biblioteca 'upload' con la configuración especificada.
        $this->load->library('upload', $config);
    }


    /**
     * Función para editar el perfil del usuario.
     */
    public function edit()
    {
        // Llama a la función de validación del formulario.
        $this->_validate();

        // Configurar la configuración de carga de archivos.
        $this->_configureUpload();

        // Verificar si la validación del formulario fue exitosa.
        if ($this->form_validation->run() == false) {
            // Si la validación falla, cargar la vista 'Profile'.
            $data['title'] = "Perfil";
            $data['user'] = $this->user;
            $this->template->load('templates/dashboard', 'profile/edit', $data);
        } else {
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            // Verificar si se está cargando una nueva imagen de perfil.
            if (empty($_FILES['picture']['name'])) {
                // Si no se selecciona una nueva imagen, actualizar la información del perfil del usuario en la base de datos.
                $insert = $this->admin->update('user', 'id_user', $input['id_user'], $input);
                if ($insert) {
                    // Mostrar un mensaje de éxito si la actualización es exitosa.
                    set_message('¡Datos Guardados!');
                } else {
                    // Mostrar un mensaje de error si la actualización falla.
                    set_message('¡Oops, Algo salió mal!', false);
                }

                // Redirigir al usuario de vuelta a la página de edición de perfil.
                redirect('profile/edit');
            }

            // Si se está cargando una nueva imagen, intentar procesar la carga redirigir al usuario
            if ($this->upload->do_upload('picture') == false) {
                // Mostrar errores de carga de archivos si la carga falla.
                set_message('' .  $this->upload->display_errors(), false);
                redirect('profile/edit');
            } else {
                // Manejar la carga exitosa de la nueva imagen de perfil.
                if (userdata('picture') != 'user.png') {
                    // Verificar si la antigua imagen de perfil no es la predeterminada ('user.png').
                    $oldImage = FCPATH . 'assets/img/avatar/' . userdata('picture');
                    if (!unlink($oldImage)) {
                        // Mostrar un mensaje de error si no se puede eliminar la antigua imagen.
                        set_message('No se pudo eliminar la imagen anterior.', false);
                        redirect('profile/edit');
                    }
                }

                // Actualizar el campo 'picture' en el perfil del usuario con el nuevo nombre de archivo.
                $input['picture'] = $this->upload->data('file_name');
                $update = $this->admin->update('user', 'id_user', $input['id_user'], $input);

                if ($update) {
                    // Mostrar un mensaje de éxito si se guardan los cambios en el perfil.
                    set_message('¡Datos Guardados!');
                } else {
                    // Mostrar un mensaje de error si no se pueden guardar los cambios.
                    set_message('¡Oops, Algo salió mal!', false);
                }

                // Redirigir al usuario de vuelta a la página de edición de perfil.
                redirect('profile/edit');
            }
        }
    }


    /**
     * Cambiar la contraseña del usuario.
     */
    public function change_password()
    {
        // Establecer reglas de validación para los campos de contraseña antigua, contraseña nueva y confirmación de contraseña.
        $this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[3]|differs[old_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[new_password]');

        // Verificar si la validación del formulario falla.
        if ($this->form_validation->run() == false) {
            // Si la validación falla, cargar la vista 'Cambiar Contraseña'
            $data['title'] = "Perfil";
            $this->template->load('templates/dashboard', 'profile/change_password', $data);
        } else {
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            $password = $input['old_password'];
            $hash = userdata('password');
            $check = password_verify($password, $hash);

            // Obtener la contraseña anterior ingresada por el usuario.
            $password = $input['old_password'];

            // Obtener el hash de contraseña almacenado en los datos de usuario actualmente en sesión.
            $hash = userdata('password');

            // Verificar si la contraseña anterior ingresada por el usuario coincide con el hash de contraseña almacenado.
            if (password_verify($password, $hash)) {
                // Si la contraseña antigua es correcta, preparar los datos de la nueva contraseña.
                $newPassword = ['password' => password_hash($input['new_password'], PASSWORD_DEFAULT)];

                // Actualizar la contraseña del usuario en la base de datos.
                if ($this->admin->update('user', 'id_user', userdata('id_user'), $newPassword)) {
                    // Mostrar un mensaje de éxito si se actualiza la contraseña.
                    set_message('¡Datos Guardados!');
                } else {
                    // Mostrar un mensaje de error si falla la actualización de la contraseña.
                    set_message('¡Oops, Algo salió mal!', false);
                }
            } else {
                // Mostrar un mensaje de error si falla la verificación de la contraseña antigua.
                set_message('La contraseña antigua es incorrecta.', false);
            }

            // Redirigir al usuario de vuelta a la página 'Cambiar Contraseña'.
            redirect('profile/change_password');
        }
    }
}
