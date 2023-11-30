<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller // Productos
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
     * Mostrar Productos.
     */
    public function index()
    {
        // Establecer el título de la página como "Productos"
        $data['title'] = "Productos";

        // Obtener datos de productos desde el modelo 'admin'
        $data['items'] = $this->admin->get_items();

        // Cargar la plantilla 'dashboard' junto con la vista de datos de productos y los datos correspondientes
        $this->template->load('templates/dashboard', 'products/data', $data);
    }


    /**
     * Realiza la validación de datos para el nombre del producto, categoría, unidad y precio.
     */
    private function _validate()
    {
        // Establecer reglas de validación para el campo 'name_item' (Nombre del Producto)
        $this->form_validation->set_rules('name_item', 'Name Item', 'required|trim');

        // Establecer reglas de validación para el campo 'id_category' (Categoría)
        $this->form_validation->set_rules('id_category', 'Category', 'required');

        // Establecer reglas de validación para el campo 'id_unit' (Unidad)
        $this->form_validation->set_rules('id_unit', 'Unit', 'required');

        // Establecer reglas de validación para el campo 'price' (Precio)
        $this->form_validation->set_rules('price', 'Price', 'required');
    }


    /**
     * Maneja la adición de nuevos productos
     */
    public function add()
    {
        // Llama a la función de validación del formulario.
        $this->_validate();

        // Comprobar si la validación ha fallado
        if ($this->form_validation->run() == false) {
            // Preparar datos para la vista en caso de validación fallida
            $data['title'] = "Productos"; // Establecer el título de la página como "Productos"
            $data['category'] = $this->admin->get('category'); // Obtener datos de categorías para la vista
            $data['unit'] = $this->admin->get('unit'); // Obtener datos de unidades para la vista

            // Generar un código para el nuevo registro basado en el último valor en la base de datos
            $last_code = $this->admin->getMaxValue('item', 'id_item'); // Obtener el último valor en la base de datos para 'id_item'
            $code_extra = substr($last_code, -4, 4); // Extraer los últimos 4 caracteres del valor obtenido
            $code_extra++; // Incrementar el valor en uno
            $number = str_pad($code_extra, 4, '0', STR_PAD_LEFT); // Asegurar que el valor tenga 4 dígitos rellenando con ceros a la izquierda si es necesario
            $data['id_item'] = 'CA' . $number; // Establecer el nuevo ID para el registro a ser insertado

            // Cargar la plantilla y vista para agregar productos
            $this->template->load('templates/dashboard', 'products/add', $data);
        } else {
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            // Insertar los datos en la tabla 'item'
            $insert = $this->admin->insert('item', $input);

            // Verificar si la inserción fue exitosa
            if ($insert) {
                // Establecer un mensaje de éxito y redirigir a la página de 'products'
                set_message('¡Datos Guardados!');
                redirect('products');
            } else {
                // En caso de error durante la inserción, establecer un mensaje de error y redirigir de nuevo a la página de agregar
                set_message('¡Oops, Algo salió mal!', false);
                redirect('products/add');
            }
        }
    }


    /**
     * Maneja la edición de productos existentes
     *
     * @param string $getId El ID del producto que se va a editar.
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
            $data['title'] = "Productos"; // Establecer el título de la página como "Productos"
            $data['category'] = $this->admin->get('category'); // Obtener datos de categorías para la vista
            $data['unit'] = $this->admin->get('unit'); // Obtener datos de unidades para la vista
            $data['item'] = $this->admin->get('item', ['id_item' => $id]); // Obtener datos del producto con el ID proporcionado

            // Cargar la plantilla y vista para editar el producto
            $this->template->load('templates/dashboard', 'products/edit', $data);
        } else {
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            // Actualizar los datos en la tabla 'item' con el ID proporcionado
            $update = $this->admin->update('item', 'id_item', $id, $input);

            // Verificar si la actualización fue exitosa
            if ($update) {
                // Establecer un mensaje de éxito y redirigir a la página de 'products'
                set_message('¡Datos Guardados!');
                redirect('products');
            } else {
                // En caso de error durante la actualización, establecer un mensaje de error y redirigir de nuevo a la página de edición
                set_message('¡Oops, Algo salió mal!', false);
                redirect('products/edit/' . $id);
            }
        }
    }


    /**
     * Elimina un producto con el ID proporcionado.
     *
     * @param string $getId El ID del producto que se va a eliminar.
     */
    public function delete($getId)
    {
        // Obtener el ID codificado de la entrada
        $id = encode_php_tags($getId);

        // Intentar eliminar los datos de la tabla 'item' con el ID proporcionado
        if ($this->admin->delete('item', 'id_item', $id)) {
            // Si la eliminación es exitosa, establecer un mensaje de éxito
            set_message('Datos Eliminados');
        } else {
            // Si algo salió mal durante la eliminación, establecer un mensaje de error
            set_message('¡Oops, Algo salió mal!', false);
        }

        // Redirigir a la página de 'products' después de la operación
        redirect('products');
    }


    /**
     * Obtiene la información de stock de un producto con el ID proporcionado.
     *
     * @param string $getId El ID del producto del cual se va a obtener la información de stock.
     */
    public function getStock($getId)
    {
        // Obtener el ID codificado de la entrada
        $id = encode_php_tags($getId);

        // Realizar una consulta para verificar el stock del producto con el ID proporcionado
        $query = $this->admin->checkStock($id);

        // Devolver la respuesta en formato JSON
        output_json($query);
    }
}
