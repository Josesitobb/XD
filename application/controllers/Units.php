<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Units extends CI_Controller // Unidades de Medida
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
     * Mostrar Unidades de Medida
     */
    public function index()
    {
        // Establecer el título de la página como "Unidades de Medida"
        $data['title'] = "Unidades de Medida";

        // Obtener datos de unidades de medida desde el modelo 'admin'
        $data['unit'] = $this->admin->get('unit');

        // Cargar la plantilla 'dashboard' junto con la vista de datos de unidades y los datos correspondientes
        $this->template->load('templates/dashboard', 'units/data', $data);
    }


    /**
     * Realiza la validación de datos para el nombre de la unidad.
     */
    private function _validate()
    {
        // Establecer reglas de validación para el campo 'unit_name' (Nombre de la Unidad)
        $this->form_validation->set_rules('unit_name', 'Nombre de la Unidad', 'required|trim');
    }


    /**
     * Maneja la adición de nuevas unidades de medida
     */
    public function add()
    {
        // Llama a la función de validación del formulario.
        $this->_validate();

        // Comprobar si la validación ha fallado
        if ($this->form_validation->run() == false) {
            // Preparar datos para la vista en caso de validación fallida
            $data['title'] = "Unidades de Medida";

            // Cargar la plantilla y vista para agregar unidades de medida
            $this->template->load('templates/dashboard', 'units/add', $data);
        } else {
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            // Insertar los datos en la tabla 'unit'
            $insert = $this->admin->insert('unit', $input);

            // Verificar si la inserción fue exitosa
            if ($insert) {
                // Establecer un mensaje de éxito y redirigir a la página de 'units'
                set_message('¡Datos Guardados!');
                redirect('units');
            } else {
                // En caso de error durante la inserción, establecer un mensaje de error y redirigir a la página de agregar
                set_message('¡Oops, Algo salió mal!', false);
                redirect('units/add');
            }
        }
    }


    /**
     * Maneja la edición de unidades de medida existentes
     *
     * @param string $getId El ID de la unidad de medida que se va a editar.
     */
    public function edit($getId)
    {
        // Obtener el ID codificado de la entrada
        $id = encode_php_tags($getId);

        // Llama a la función de validación del formulario.
        $this->_validate();

        // Comprobar si la validación ha fallado
        if ($this->form_validation->run() == false) {
            // Preparar datos para la vista en caso de validación fallida
            $data['title'] = "Unidades de Medida";

            // Obtener datos de la unidad de medida con el ID proporcionado
            $data['unit'] = $this->admin->get('unit', ['id_unit' => $id]);

            // Cargar la plantilla y vista para editar la unidad de medida
            $this->template->load('templates/dashboard', 'units/edit', $data);
        } else {
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            // Actualizar los datos en la tabla 'unit' con el ID proporcionado
            $update = $this->admin->update('unit', 'id_unit', $id, $input);

            // Verificar si la actualización fue exitosa
            if ($update) {
                // Establecer un mensaje de éxito y redirigir a la página de 'units'
                set_message('¡Datos Guardados!');
                redirect('units');
            } else {
                // En caso de error durante la actualización, establecer un mensaje de error y redirigir a la página de edición
                set_message('¡Oops, Algo salió mal!', false);
                redirect('units/edit/' . $id);
            }
        }
    }


    /**
     * Elimina una unidad de medida con el ID proporcionado.
     *
     * @param string $getId El ID de la unidad de medida que se va a eliminar.
     */
    public function delete($getId)
    {
        // Obtener el ID codificado de la entrada
        $id = encode_php_tags($getId);

        // Intentar eliminar los datos de la tabla 'unit' con el ID proporcionado
        if ($this->admin->delete('unit', 'id_unit', $id)) {
            // Si la eliminación es exitosa, establecer un mensaje de éxito
            set_message('Datos Eliminados');
        } else {
            // Si algo salió mal durante la eliminación, establecer un mensaje de error
            set_message('¡Oops, Algo salió mal!', false);
        }

        // Redirigir a la página de 'units' después de la operación
        redirect('units');
    }
}
