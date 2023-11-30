<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Outgoing_Goods extends CI_Controller // Productos Salientes
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
     * Función que maneja la página principal de la aplicación.
     */
    public function index()
    {
        // Título de la página
        $data['title'] = "Productos Salientes";

        // Obtener productos salientes a través del modelo admin
        $data['outgoing_goods'] = $this->admin->getOutgoingGoods();

        // Identificador de productos salientes (en blanco por defecto)
        $data['id_outgoing_goods'] = "";

        // Cargar la plantilla principal y la vista de datos de productos salientes
        $this->template->load('templates/dashboard', 'outgoing_goods/data', $data);
    }


    /**
     * Realiza la validación de los datos ingresados para los Productos Salientes.
     */
    private function _validate()
    {
        // Configurar reglas de validación para el nombre del destinatario
        $this->form_validation->set_rules('recipient_name', 'Recipient Name', 'required|trim');

        // Configurar reglas de validación para la dirección
        $this->form_validation->set_rules('address', 'Address', 'required|trim');

        // Configurar reglas de validación para el descuento
        // El descuento debe ser un valor numérico mayor o igual a 0
        // y menor o igual al valor total proporcionado en el formulario
        $this->form_validation->set_rules('discount', 'Discount', "trim|greater_than_equal_to[0]|less_than_equal_to[{$this->input->post('total_nominal')}]");
    }


    /**
     * Función privada para validar el carrito de ventas.
     */
    private function _validate_cart()
    {
        // Configurar reglas de validación para el identificador del ítem
        $this->form_validation->set_rules('id_item', 'Item', 'required');

        // Obtener el valor del ítem del formulario
        $input = $this->input->post('id_item', true);

        if (!empty($input)) { // El campo está vacío
            // Obtener el stock del ítem a través del modelo admin
            $stock = $this->admin->get('item', ['id_item' => $input])['stock'];

            // Establecer un límite de stock válido para la validación
            $stock_valid = $stock + 0.1;

            // Configurar reglas de validación para la cantidad de salida.
            // Se requiere un valor, se elimina cualquier espacio en blanco, debe ser numérico,
            // debe ser mayor que 0 y no puede ser mayor que el stock válido del ítem.
            $this->form_validation->set_rules(
                'quantity_out',
                'Quantity Out',
                "required|trim|numeric|greater_than[0]|less_than[{$stock_valid}]",
                [
                    'less_than' => "Las Salidas Totales no pueden ser mayores que {$stock}"
                ]
            );
        }
    }


    /**
     * Función para agregar productos salientes.
     */
    public function add()
    {
        // Llama a la función de validación del formulario.
        $this->_validate();

        // Obtener los ítems disponibles con stock
        $data['items'] = $this->admin->get('item', null, ['stock >' => 0]);

        // Verificar si se ha enviado el formulario con el campo 'id_item' en POST
        if ($this->input->post('id_item')) {
            // Obtener los datos del ítem seleccionado en base al 'id_item' seleccionado
            $selected_item_id = $this->input->post('id_item');
            $selected_item_data = $this->admin->get('item', null, ['id_item' => $selected_item_id]);

            // Asignar los datos del ítem seleccionado a la variable 'selected_item_data' en el arreglo de datos 'data'
            $data['selected_item_data'] = $selected_item_data;
        }

        // Si la validación del formulario ha fallado
        if ($this->form_validation->run() == false) {
            // Configurar el título de la página
            $data['title'] = "Productos Salientes";
            // Obtener los ítems disponibles con stock
            $data['items'] = $this->admin->get('item', null, ['stock >' => 0]);

            $code = 'S' . date('ymd'); // Generar un código para productos salientes basado en la fecha actual
            // Obtener el último valor de 'id_outgoing_goods' de la base de datos
            $code_last = $this->admin->getMaxValue('outgoing_goods', 'id_outgoing_goods', $code);
            $code_extra = substr($code_last, -4, 4); // Extraer los últimos 4 caracteres del código anterior
            $code_extra++; // Incrementar en uno el valor extraído
            // Rellenar el valor extraído con ceros a la izquierda hasta tener 4 dígitos
            $number = str_pad($code_extra, 4, '0', STR_PAD_LEFT);

            $data['id_outgoing_goods'] = $code . $number; // Combinar el código base con el número generado

            // Cargar la plantilla de la página de adición de productos salientes
            $this->template->load('templates/dashboard', 'outgoing_goods/add', $data);
        } else {
            // Procesar el formulario de adición exitoso
            $input = array(
                'id_outgoing_goods' => $this->input->post('id_outgoing_goods'), // Identificador de productos salientes
                'id_user' => $this->input->post('id_user'), // Identificador de usuario
                'departure_date' => $this->input->post('departure_date'), // Fecha de salida
                'recipient_name' => $this->input->post('recipient_name'), // Nombre del destinatario
                'address' => $this->input->post('address'), // Dirección de entrega
                'discount' => $this->input->post('discount'), // Descuento aplicado
                'total_amount' => $this->input->post('total_nominal'), // Monto total
            );

            if ($this->input->post('grand_total') == "") {
                // Si no se proporciona el gran total, se utiliza el valor oculto del gran total
                $input['grand_total'] = $this->input->post('grand_total_hidden');
            } else {
                // Si se proporciona el gran total, se utiliza ese valor
                $input['grand_total'] = $this->input->post('grand_total');
            }

            // Insertar datos en la tabla 'outgoing_goods'
            $insert = $this->admin->insert('outgoing_goods', $input);

            // Obtener el ID de los productos salientes insertados
            $id_outgoing_goods = $this->input->post('id_outgoing_goods');

            // Guardar el carrito relacionado con los productos salientes
            $this->admin->saveCart($id_outgoing_goods);

            // Destruir el carrito
            $this->cart->destroy();

            // Si la insercion éxitosa
            if ($insert) {
                // Mostrar mensaje de éxito y redirigir
                set_message('¡Datos Guardados!');
                redirect('outgoing_goods');
            } else {
                // Mostrar mensaje de error y redirigir a la página de adición
                set_message('¡Oops, Algo salió mal!', false);
                redirect('outgoing_goods/add');
            }
        }
    }


    /**
     * Función para agregar productos al carrito.
     */
    public function add_to_cart()
    {
        // Validar los datos del carrito
        $this->_validate_cart();

        // Si la validación del formulario ha fallado
        if ($this->form_validation->run() == false) {
            // Establecer el título de la página
            $data['title'] = "Productos Salientes";
            // Obtener los ítems disponibles con stock
            $data['items'] = $this->admin->get('item', null, ['stock >' => 0]);

            $code = 'S-' . date('y'); // Crear un código de salida basado en el año actual
            // Obtener el último código de salida de la base de datos
            $code_last = $this->admin->getMaxValue('outgoing_goods', 'id_outgoing_goods', $code);
            $code_extra = substr($code_last, -4, 4); // Extraer los últimos 4 caracteres del código
            $code_extra++; // Incrementar el valor extraído
            $number = str_pad($code_extra, 4, '0', STR_PAD_LEFT); // Rellenar con ceros a la izquierda si es necesario

            $data['id_outgoing_goods'] = $code . $number;  // Crear un nuevo código de salida

            $this->template->load('templates/dashboard', 'outgoing_goods/add', $data);
            // Cargar la plantilla de dashboard con la vista de adición de productos salientes
        } else {
            // Si la validación del formulario es exitosa

            // Obtener el ID del ítem del formulario
            $id_item = $this->input->post('id_item');
            // Obtener los datos del ítem seleccionado
            $item = $this->admin->getItem($id_item);

            // Crear un arreglo de datos para agregar al carrito
            $data = array(
                'id'        => $item->id_item, // ID del ítem seleccionado
                'name'      => $item->name_item, // Nombre del ítem seleccionado
                'price'     => str_replace(",", "", $this->input->post('price')), // Precio del ítem sin comas
                'qty'       => $this->input->post('quantity_out'), // Cantidad del ítem desde el formulario
                'amount'   => str_replace(",", "", $this->input->post('total_nominal')) // Monto total sin comas desde el formulario
            );

            // Insertar los datos en el carrito
            $inserted = $this->cart->insert($data);

            // Si la inserción es exitosa
            if ($inserted) {
                // Mostrar mensaje de éxito y redirigir
                set_message('¡Datos Guardados!');
            } else {
                // Mostrar mensaje de error y redirigir a la página de adición
                set_message('¡Oops, Algo salió mal!', false);
            }

            redirect('outgoing_goods/add');
            // Redirigir a la página de adición de productos salientes
        }
    }


    /**
     * Función para eliminar un elemento del carrito.
     */
    public function remove()
    {
        // Obtener el ID de fila desde la URL
        $row_id = $this->uri->segment(3);

        // Actualizar la fila del carrito para establecer la cantidad en 0 (eliminar)
        $this->cart->update(array(
            'rowid' => $row_id,
            'qty' => 0
        ));

        // Redirigir de nuevo a la página de agregar productos
        redirect('outgoing_goods/add');
    }


    /**
     * Función para eliminar un registro de productos salientes.
     * 
     * @param $getId: El ID del registro a eliminar.
     */
    public function delete($getId)
    {
        // Obtener y limpiar el ID del registro desde la URL
        $id = encode_php_tags($getId);

        if ($id) {
            // Obtener los detalles del registro a eliminar
            $items = $this->admin->getOutgoingGoodsByID2($id)->result_array();

            // Recorrer los detalles para actualizar el stock de los ítems relacionados
            foreach ($items as $i) {
                $data['stock'] = $i['quantity_out'] + $i['stock'];
                $this->admin->update_stock($i['id_item'], $data);
            }
        }

        // Intentar eliminar el registro de productos salientes
        if ($this->admin->delete('outgoing_goods', 'id_outgoing_goods', $id)) {
            // Mostrar mensaje de éxito si se elimina correctamente
            set_message('Datos Eliminados');
        } else {
            // Mostrar mensaje de error si algo sale mal durante la eliminación
            set_message('¡Oops, Algo salió mal!', false);
        }

        // Redirigir de nuevo a la página de productos salientes
        redirect('outgoing_goods');
    }


    /**
     * Función para generar una factura y nota de entrega.
     * 
     * @param $id: El ID del registro de productos salientes asociado a la factura.
     */
    public function invoice_delivery_note($id)
    {
        // Establecer el título de la página
        $x['title'] = "Factura";

        // Obtener los datos del registro de productos salientes asociado a la factura
        $x['data'] = $this->admin->getOutgoingGoodsByID2($id);

        // Cargar la vista de la carta de factura
        $this->load->view('invoice/letter', $x);
    }


    /**
     * Función para generar una factura.
     * 
     * @param $id: El ID del registro de productos salientes asociado a la factura.
     */
    public function invoice_bill($id)
    {
        // Obtener los datos del registro de productos salientes asociado a la factura
        $x['data'] = $this->admin->getOutgoingGoodsByID2($id);

        // Cargar la vista de la factura
        $this->load->view('invoice/bill', $x);
    }


    /**
     * Función para generar una nota de remisión.
     * 
     * @param $id: El ID del registro de productos salientes asociado a la nota de remisión.
     */
    public function delivery_note($id)
    {
        // Establecer el título de la página
        $x['title'] = "Nota de Remisión";

        // Obtener los datos del registro de productos salientes asociado a la nota de entrega
        $x['data'] = $this->admin->getOutgoingGoodsByID($id);

        // Cargar la vista de la nota de entrega
        $this->load->view('invoice/delivery_note', $x);
    }
}
