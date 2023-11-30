<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller // Tablero de Control
{

    public function __construct()
    {
        parent::__construct();

        // Verificar si el usuario ya está conectado.
        // Redirigir al usuario a la página de autenticación si no esta conectado.
        check_login();

        // Cargar el modelo de administrador como 'admin'.
        $this->load->model('Admin_model', 'admin');
    }


    /**
     * Controla la vista del tablero de control.
     *
     * Este método establece el título de la página y recopila datos relevantes para mostrar 
     * en el tablero de control.
     * 
     * Los datos incluyen conteos de diversas entidades de datos, transacciones recientes 
     * y datos para gráficos mensuales.
     * 
     * Los resultados se almacenan en el arreglo $data y se cargan en la vista del tablero.
     */
    public function index()
    {
        // Establecer el título para la página del tablero de control.
        $data['title'] = "Tablero de Control";

        // Recuperar y asignar conteos (contar el número de registros) para diversas entidades de datos.
        $data['items'] = $this->admin->countRecords('item');
        $data['incoming_goods'] = $this->admin->countRecords('incoming_goods');
        $data['outgoing_goods'] = $this->admin->countRecords('outgoing_goods_detail');
        $data['suppliers'] = $this->admin->countRecords('supplier');
        $data['stock'] = $this->admin->calculateSum('item', 'stock');
        $data['earnings'] = $this->admin->calculateSum('outgoing_goods', 'grand_total');
        $data['low_stock_products'] = $this->admin->findRecordsWhereMin('item', 'stock', 10);

        // Recuperar transacciones recientes para productos entrantes y productos salientes.
        $data['transactions'] = [
            'incoming_goods' => $this->admin->getIncomingGoods(5),
            'outgoing_goods' => $this->admin->getIncomingGoodsDashboard(5)
        ];

        // Datos para el grande gráfico : Recuperar datos para gráficos mensuales.
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        $data['monthly_incoming'] = []; // inicializar matriz vacía 
        $data['monthly_outgoing'] = []; // inicializar matriz vacía 

        foreach ($months as $month) { // Iterar cada 'mes' en 'meses'
            // Obtener y almacenar el recuento de bienes entrantes para el mes actual.
            $data['monthly_incoming'][] = $this->admin->countIncomingGoods($month);
            // Obtener y almacenar el recuento de bienes salientes para el mes actual.
            $data['monthly_outgoing'][] = $this->admin->countOutgoingGoods($month);
        }

        // Cargar la vista del tablero utilizando la biblioteca 'template'.
        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}
