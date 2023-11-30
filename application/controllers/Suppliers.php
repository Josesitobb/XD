<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Suppliers extends CI_Controller // Proveedores
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
     * Mostrar Proveedores.
     */
    public function index() 
    {
        // Establecer el título de la página como "Proveedores"
        $data['title'] = "Proveedores";

        // Obtener datos de proveedores desde el modelo 'admin'
        $data['suppliers'] = $this->admin->get('supplier');

        // Cargar la plantilla 'dashboard' junto con la vista de datos de proveedores y los datos correspondientes
        $this->template->load('templates/dashboard', 'suppliers/data', $data);
    }


    /**
     * Realiza la validación de datos para el nombre del proveedor, número de teléfono y dirección.
     */
    private function _validate()
    {
        // Establecer reglas de validación para el campo 'supplier_name' (Nombre del Proveedor)
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required|trim');

        // Establecer reglas de validación para el campo 'phone_number' (Número de Teléfono)
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|numeric');

        // Establecer reglas de validación para el campo 'address' (Dirección)
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
    }


    /**
     * Maneja la adición de nuevos proveedores
     */
    public function add()
    {
        // Llama a la función de validación del formulario.
        $this->_validate();

        // Comprobar si la validación ha fallado
        if ($this->form_validation->run() == false) {
            // Preparar datos para la vista en caso de validación fallida
            $data['title'] = "Proveedores";

            // Cargar la plantilla y vista para agregar proveedores
            $this->template->load('templates/dashboard', 'suppliers/add', $data);
        } else { 
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            // Insertar los datos en la tabla 'supplier'
            $inserted = $this->admin->insert('supplier', $input);

            // Verificar si la inserción fue exitosa
            if ($inserted) {
                // Establecer un mensaje de éxito y redirigir a la página de 'suppliers'
                set_message('¡Datos Guardados!');
                redirect('suppliers');
            } else {
                // En caso de error durante la inserción, establecer un mensaje de error y redirigir a la página de agregar
                set_message('¡Oops, Algo salió mal!', false);
                redirect('supplier/add');
            }
        }
    }


    /**
     * Maneja la edición de proveedores existentes
     *
     * @param string $getId El ID del proveedor que se va a editar.
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
            $data['title'] = "Proveedores";

            // Obtener datos del proveedor con el ID proporcionado
            $data['supplier'] = $this->admin->get('supplier', ['id_supplier' => $id]);

            // Cargar la plantilla y vista para editar el proveedor
            $this->template->load('templates/dashboard', 'suppliers/edit', $data);
        } else {
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            // Actualizar los datos en la tabla 'supplier' con el ID proporcionado
            $update = $this->admin->update('supplier', 'id_supplier', $id, $input);

            // Verificar si la actualización fue exitosa
            if ($update) {
                // Establecer un mensaje de éxito y redirigir a la página de 'suppliers'
                set_message('¡Datos Guardados!');
                redirect('suppliers');
            } else {
                // En caso de error durante la actualización, establecer un mensaje de error y redirigir a la página de edición
                set_message('¡Oops, Algo salió mal!', false);
                redirect('suppliers/edit/' . $id);
            }
        }
    }


    /**
     * Elimina un proveedor con el ID proporcionado.
     *
     * @param string $getId El ID del proveedor que se va a eliminar.
     */
    public function delete($getId)
    {
        // Obtener el ID codificado de la entrada
        $id = encode_php_tags($getId);

        // Intentar eliminar los datos de la tabla 'supplier' con el ID proporcionado
        if ($this->admin->delete('supplier', 'id_supplier', $id)) {
            // Si la eliminación es exitosa, establecer un mensaje de éxito
            set_message('Datos Eliminados');
        } else {
            // Si algo salió mal durante la eliminación, establecer un mensaje de error
            set_message('¡Oops, Algo salió mal!', false);
        }

        // Redirigir a la página de 'suppliers' después de la operación
        redirect('suppliers');
    }
}
