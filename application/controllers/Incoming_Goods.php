<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Incoming_Goods extends CI_Controller // Productos Entrantes
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
     * Mostrar Productos Entrantes.
     */
    public function index()
    {
        // Título para la página de Productos Entrantes
        $data['title'] = "Productos Entrantes";

        // Obtener los productos entrantes desde el modelo 'admin'
        $data['incoming_goods'] = $this->admin->getIncomingGoods();

        // Cargar la plantilla 'dashboard' con la vista de datos de productos entrantes y los datos
        $this->template->load('templates/dashboard', 'incoming_goods/data', $data);
    }


    /**
     * Realiza la validación de los datos ingresados para los Productos Entrantes.
     */
    private function _validate()
    {
        // Validación de la fecha de llegada
        $this->form_validation->set_rules('arrival_date', 'Arrival Date', 'required|trim');

        // Validación del proveedor
        $this->form_validation->set_rules('id_supplier', 'Supplier', 'required');

        // Validación del artículo
        $this->form_validation->set_rules('id_item', 'Item', 'required');

        // Validación de la cantidad
        $this->form_validation->set_rules('quantity_in', 'Quantity', 'required|trim|numeric|greater_than[0]');
    }


    /**
     * Maneja la adición de nuevos datos de Productos Entrantes
     */
    public function add()
    {
        // Llama a la función de validación del formulario.
        $this->_validate();

        // Comprobar si la validación ha fallado
        if ($this->form_validation->run() == false) {
            // Preparar datos para la vista en caso de validación fallida
            $data['title'] = "Productos Entrantes"; // Establecer el título para la página como "Productos Entrantes"
            $data['supplier'] = $this->admin->get('supplier'); // Obtener datos de proveedores para la vista
            $data['item'] = $this->admin->get('item'); // Obtener datos de artículos para la vista

            // Generar un código para el nuevo registro basado en la fecha y el último valor en la base de datos
            $code = 'I' . date('ymd'); // Crear un código basado en la fecha actual (ejemplo: 'I210913')
            $code_last = $this->admin->getMaxValue('incoming_goods', 'id_incoming_goods', $code); // Obtener el último valor en la base de datos que coincide con el código generado
            $code_extra = substr($code_last, -4, 4); // Extraer los últimos 4 caracteres del valor obtenido
            $code_extra++; // Incrementar el valor en uno
            $number = str_pad($code_extra, 4, '0', STR_PAD_LEFT); // Asegurar que el valor tenga 4 dígitos rellenando con ceros a la izquierda si es necesario
            $data['id_incoming_goods'] = $code . $number; // Establecer el nuevo ID para el registro a ser insertado


            // Cargar la plantilla y vista para agregar datos
            $this->template->load('templates/dashboard', 'incoming_goods/add', $data);
        } else {
            // Obtener los datos del formulario enviado
            $input = $this->input->post(null, true);

            // Insertar los datos en la tabla 'incoming_goods'
            $insert = $this->admin->insert('incoming_goods', $input);

            // Verificar si la inserción fue exitosa
            if ($insert) {
                // Establecer un mensaje de éxito y redirigir a la página de 'incoming_goods'
                set_message('¡Datos Guardados!');
                redirect('incoming_goods');
            } else {
                // En caso de error durante la inserción, establecer un mensaje de error y redirigir de nuevo a la página de agregar
                set_message('¡Oops, Algo salió mal!', false);
                redirect('incoming_goods/add');
            }
        }
    }


    /**
     * Elimina los datos de los Productos Entrantes con el ID proporcionado.
     *
     * @param string $getId El ID codificado de la entrada que se va a eliminar.
     */
    public function delete($getId)
    {
        // Obtener el ID codificado de la entrada
        $id = encode_php_tags($getId);

        // Intentar eliminar los datos de 'incoming_goods' (productos entrantes) con el ID proporcionado
        if ($this->admin->delete('incoming_goods', 'id_incoming_goods', $id)) {
            // Si la eliminación es exitosa, establecer un mensaje de éxito
            set_message('Datos Eliminados');
        } else {
            // Si algo salió mal durante la eliminación, establecer un mensaje de error
            set_message('¡Oops, Algo salió mal!', false);
        }

        // Redirigir a la página de 'incoming_goods' después de la operación
        redirect('incoming_goods');
    }
}
