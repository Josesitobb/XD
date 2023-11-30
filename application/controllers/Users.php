<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller // Usarios
{

    public function __construct()
    {
        parent::__construct();

        // Verificar si el usuario ya está conectado.
        // Redirigir al usuario a la página de autenticación si no esta conectado.
        check_login();

        // Redireccionar al tablero de control si el usuario no es un administrador.
        if (!is_admin()) {
            redirect('dashboard');
        }

        // Cargar el modelo de administrador como 'admin'.
        $this->load->model('Admin_model', 'admin');
        // Carga la biblioteca 'form_validation'.
        $this->load->library('form_validation');
    }


    /**
     * Cargar la página de administración de usuarios.
     */
    public function index()
    {
        // Establecer el título de la página.
        $data['title'] = "Administrar Usuarios";

        // Obtener una lista de usuarios utilizando el modelo 'admin' y el ID del usuario actual.
        $data['users'] = $this->admin->get_users(userdata('id_user'));

        // Cargar la vista de datos de usuario utilizando la plantilla 'dashboard'.
        $this->template->load('templates/dashboard', 'users/data', $data);
    }


    /**
     * Definir reglas de validación para los campos de datos del usuario.
     *
     * @param string $mode Modo de operación ('add' para agregar, 'edit' para editar).
     */
    private function _validate($mode)
    {
        // Regla de validación para el campo 'name' (Nombre).
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        // Regla de validación para el campo 'phone_number' (Número de Teléfono).
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim');

        // Regla de validación para el campo 'role' (Rol).
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        // Comprobar si el modo es 'add' (agregar usuario).
        if ($mode == 'add') {
            // Reglas de validación adicionales para crear un nuevo usuario.

            // Regla de validación para el campo 'username' (Nombre de Usuario).
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|alpha_numeric');

            // Regla de validación para el campo 'email' (Correo Electrónico).
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');

            // Regla de validación para el campo 'password' (Contraseña).
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');

            // Regla de validación para el campo 'password2' (Confirmar Contraseña).
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]|trim');
        } else {
            // Reglas de validación para editar un usuario existente.

            // Obtener los datos del usuario existente.
            $db = $this->admin->get('user', ['id_user' => $this->input->post('id_user', true)]);

            // Comprobar si no se encontraron datos del usuario en la base de datos.
            if (empty($db)) {
                // Regla de validación para el campo 'username' (Nombre de Usuario).
                $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric');

                // Regla de validación para el campo 'email' (Correo Electrónico).
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            } else {
                // Obtener el nombre de usuario y el correo electrónico existentes.
                $username = $this->input->post('username', true);
                $email = $this->input->post('email', true);

                // Determinar si se deben aplicar reglas de validación únicas para nombre de usuario y correo electrónico.
                $uniq_username = $db['username'] == $username ? '' : '|is_unique[user.username]';
                $uniq_email = $db['email'] == $email ? '' : '|is_unique[user.email]';

                // Regla de validación para el campo 'username' (Nombre de Usuario) con consideración de unicidad.
                $this->form_validation->set_rules('username', 'Nombre de Usuario', 'required|trim|alpha_numeric' . $uniq_username);

                // Regla de validación para el campo 'email' (Correo Electrónico) con consideración de unicidad.
                $this->form_validation->set_rules('email', 'Correo Electrónico', 'required|trim|valid_email' . $uniq_email);
            }
        }
    }


    /**
     * Agregar un nuevo usuario
     */
    public function add()
    {
        // Validar la entrada del usuario para agregar un nuevo usuario
        $this->_validate('add');

        // Comprobar si la validación ha fallado
        if ($this->form_validation->run() == false) {
            // Si la validación falla, cargar la vista 'Agregar Usuario'
            $data['title'] = "Administrar Usuarios";
            $this->template->load('templates/dashboard', 'users/add', $data);
        } else {
            // Obtener y sanitizar todos los datos POST enviados por el usuario para seguridad.
            $input = $this->input->post(null, true);
            $input_data = [
                'name'          => $input['name'],          // Mapear la entrada 'name' al campo 'name'.
                'username'      => $input['username'],      // Mapear la entrada 'username' al campo 'username'.
                'email'         => $input['email'],         // Mapear la entrada 'email' al campo 'email'.
                'phone_number'  => $input['phone_number'],  // Mapear la entrada 'phone_number' al campo 'phone_number'.
                'role'          => $input['role'],          // Mapear la entrada 'role' al campo 'role'.
                'password'      => password_hash($input['password'], PASSWORD_DEFAULT), // Hashear y almacenar la contraseña.
                'created_at'    => time(),                  // Establecer la marca de tiempo 'created_at'.
                'picture'       => 'user.png'               // Imagen de perfil de usuario por defecto.
            ];

            if ($this->admin->insert('user', $input_data)) {
                // Si la inserción de datos es exitosa, establecer un mensaje de éxito y redirigir a la página 'users'.
                set_message('¡Datos Guardados!');
                redirect('users');
            } else {
                // Si algo sale mal con la inserción, establecer un mensaje de error y redirigir a la página 'user/add'.
                set_message('¡Oops, Algo salió mal!', false);
                redirect('users/add');
            }
        }
    }


    /**
     * Editar un usuario existente.
     *
     * @param string $getId El ID del usuario a editar.
     */
    public function edit($getId)
    {
        // Recuperar de manera segura el ID de usuario y prevenir posibles inyecciones de código.
        $id = encode_php_tags($getId);

        // Validar la entrada del usuario basada en el modo 'editar'.
        $this->_validate('edit');

        // Comprobar si la validación ha fallado
        if ($this->form_validation->run() == false) {
            // Si la validación falla, cargar la vista 'Editar Usuario' con los datos del usuario para editar.
            $data['title'] = "Administrar Usuarios";
            $data['users'] = $this->admin->get('user', ['id_user' => $id]);
            $this->template->load('templates/dashboard', 'users/edit', $data);
        } else {
            // Obtener y sanear todos los datos POST enviados por el usuario para seguridad.
            $input = $this->input->post(null, true);
            $input_data = [
                'name'          => $input['name'],          // Mapear la entrada 'name' al campo 'name'.
                'username'      => $input['username'],      // Mapear la entrada 'username' al campo 'username'.
                'email'         => $input['email'],         // Mapear la entrada 'email' al campo 'email'.
                'phone_number'  => $input['phone_number'],  // Mapear la entrada 'phone_number' al campo 'phone_number'.
                'role'          => $input['role'],          // Mapear la entrada 'role' al campo 'role'.
            ];

            if ($this->admin->update('user', 'id_user', $id, $input_data)) {
                // Si la actualización es exitosa, establecer un mensaje de éxito y redirigir a la página 'users'.
                set_message('¡Datos Guardados!');
                redirect('users');
            } else {
                // Si la actualización falla, establecer un mensaje de error y redirigir a la página 'users/edit' para el usuario específico.
                set_message('¡Oops, Algo salió mal!', false);
                redirect('users/edit/' . $id);
            }
        }
    }


    /**
     * Elimina un usuario con un ID especificado.
     *
     * @param string $getId El ID del usuario a eliminar.
     */
    public function delete($getId)
    {
        // Recupera de manera segura el ID de usuario y evita posibles inyecciones de código.
        $id = encode_php_tags($getId);

        // Intenta eliminar al usuario de la tabla 'user'.
        if ($this->admin->delete('user', 'id_user', $id)) {
            // Si la eliminación es exitosa, establece un mensaje de éxito.
            set_message('Datos Eliminados');
        } else {
            // Si la eliminación falla, establece un mensaje de error.
            set_message('¡Oops, Algo salió mal!', false);
        }

        // Redirecciona de nuevo a la página de 'users'.
        redirect('users');
    }


    /**
     * Alternar el estado de activación de un usuario.
     *
     * @param string $getId El ID de usuario para identificar al usuario.
     */
    public function toggle($getId)
    {
        // Recupera de manera segura el ID de usuario y evita posibles inyecciones de código.
        $id = encode_php_tags($getId);

        // Obtener el estado actual de activación del usuario.
        $status = $this->admin->get('user', ['id_user' => $id])['is_active'];

        // Alternar el estado de activación del usuario: si está activo, desactivar; si está desactivado, activar.
        $toggle = $status ? 0 : 1;

        // Determinar el mensaje apropiado basado en la acción de alternar.
        $msg = $toggle ? 'Usuario Activado' : 'Usuario Desactivado';

        // Actualizar el estado de activación del usuario en la base de datos.
        if ($this->admin->update('user', 'id_user', $id, ['is_active' => $toggle])) {
            // Establecer un mensaje de éxito basado en la acción de alternar.
            set_message($msg);
        } else {
            // Si falla, establecer un mensaje de error.
            set_message('¡Oops, Algo salió mal!', false);
        }

        // Redirigir de nuevo a la página de gestión de usuarios.
        redirect('users');
    }
}
