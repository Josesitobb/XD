<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller // Categorias
{


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
    }


    /**
     * Método para mostrar la página de categorías.
     */
    public function index()
    {
        // Establece el título de la página.
        $data['title'] = "Categorías";
        // Recupera datos de categoría del modelo 'admin'
        $data['category'] = $this->admin->get('category');
        // Carga una plantilla con los datos.
        $this->template->load('templates/dashboard', 'categories/data', $data);
    }


    /**
     * Método privado para establecer reglas de validación del formulario
     */
    private function _validate()
    {
        // Establece reglas de validación para el campo 'category_name'.
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
    }


    /**
     * Método para agregar una categoría.
     */
    public function add()
    {
        // Llama a la función de validación del formulario.
        $this->_validate();

        // Si la validacion del formulario falla
        if ($this->form_validation->run() == false) {
            // Establece el título de la página.
            $data['title'] = "Categorías";
            // Carga el formulario de agregar categoría.
            $this->template->load('templates/dashboard', 'categories/add', $data);
        } else { // Exito de la validacion del formulario

            // Obtiene de forma segura los datos del formulario.
            $input = $this->input->post(null, true);
            // Inserta datos en la tabla 'category'.
            $insert = $this->admin->insert('category', $input);

            // Si la inserción fue exitosa
            if ($insert) {
                // Establece un mensaje de éxito.
                set_message('¡Los Datos fueron Guardados!');
                // Redirige a la página 'categories'.
                redirect('categories');
            } else {
                // Establece un mensaje de error.
                set_message('¡Oops, Algo salió mal!', false);
                // Redirige a la página 'add' en caso de error.
                redirect('categories/add');
            }
        }
    }


    /**
     * Método para editar una categoría.
     *
     * @param string $getId El ID de la categoría a editar.
     */
    public function edit($getId)
    {
        // Codifica y recupera el ID de categoría.
        $id = encode_php_tags($getId);

        // Llama a la función de validación del formulario.
        $this->_validate();

        // Si la validacion del formulario falla
        if ($this->form_validation->run() == false) {
            // Establece el título de la página.
            $data['title'] = "Categorías";
            // Recupera datos de categoría para editar.
            $data['category'] = $this->admin->get('category', ['id_category' => $id]);

            // Carga el formulario de edición de categoría.
            $this->template->load('templates/dashboard', 'categories/edit', $data);
        } else { // Exito de la validacion del formulario
            // Obtiene de forma segura los datos del formulario.
            $input = $this->input->post(null, true);

            // Actualiza datos en la tabla 'category'.
            $update = $this->admin->update('category', 'id_category', $id, $input);

            // La actualizacion fue exitosa
            if ($update) {
                // Establece un mensaje de éxito.
                set_message('¡Los Datos fueron Guardados!');
                // Redirige a la página 'categories'.
                redirect('categories');
            } else {
                // Establece un mensaje de error.
                set_message('¡Oops, Algo salió mal!', false);
                // Redirige a la página 'add' en caso de error.
                redirect('categories/add');
            }
        }
    }


    /**
     * Método para eliminar una categoría.
     *
     * @param string $getId El ID de la categoría a eliminar.
     */
    public function delete($getId)
    {
        // Codifica y recupera el ID de categoría.
        $id = encode_php_tags($getId);

        // Eliminar la categoria (True si éxito, False si falla)
        if ($this->admin->delete('category', 'id_category', $id)) {
            // Establece un mensaje de éxito al eliminar.
            set_message('Datos Eliminados');
        } else {
            // Establece un mensaje de error en caso de fallo en la eliminación.
            set_message('¡Oops, Algo salió mal!', false);
        }

        // Redirige a la página 'categories'.
        redirect('categories');
    }
}
