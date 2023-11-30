<?php // Done
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller // Reportes
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
     * Maneja la generación de informes de transacciones
     */
    public function index()
    {
        // Establecer reglas de validación para el campo 'transaction' (Transacción) - Debe ser uno de: 'incoming_goods', 'outgoing_goods', 'outgoing_goods_total'
        $this->form_validation->set_rules('transaction', 'Transaction', 'required|in_list[incoming_goods,outgoing_goods,outgoing_goods_total]');

        // Establecer reglas de validación para el campo 'date' (Fecha) - Debe estar presente
        $this->form_validation->set_rules('date', 'Date', 'required');

        // Comprobar si la validación ha fallado
        if ($this->form_validation->run() == false) {
            // Preparar datos para la vista en caso de validación fallida
            $data['title'] = "Obtener Reporte";

            // Cargar la plantilla y vista para generar un nuevo informe
            $this->template->load('templates/dashboard', 'reports/new', $data);
        } else {
            $input = $this->input->post(null, true); // Obtener los datos del formulario enviado
            $table = $input['transaction']; // Obtener el valor del campo 'transaction' del formulario y almacenarlo en la variable $table
            $date = $input['date']; // Obtener el valor del campo 'date' del formulario y almacenarlo en la variable $date
            $break = explode(' - ', $date); // Separar la cadena de fecha en dos partes utilizando ' - ' como delimitador y almacenarlas en un arreglo $break
            $start = date('Y-m-d', strtotime($break[0])); // Obtener la primera parte del arreglo $break, convertirla en una fecha en formato 'Y-m-d' y almacenarla en $start
            $end = date('Y-m-d', strtotime(end($break))); // Obtener la última parte del arreglo $break, convertirla en una fecha en formato 'Y-m-d' y almacenarla en $end

            $query = ''; // Inicializar la variable $query como una cadena vacía

            if ($table == 'incoming_goods') {
                // Si se seleccionó 'incoming_goods', obtener los datos de productos entrantes en el rango de fechas especificado
                $query = $this->admin->getIncomingGoods(null, null, ['start' => $start, 'end' => $end]);
            } elseif ($table == 'outgoing_goods') {
                // Si se seleccionó 'outgoing_goods', obtener los datos de productos salientes en el rango de fechas especificado
                $query = $this->admin->getOutgoingGoods(null, null, ['start' => $start, 'end' => $end]);
            } else {
                // Si no se seleccionó ninguna de las opciones anteriores, obtener los datos de productos salientes en el rango de fechas especificado
                $query = $this->admin->getOutgoingGoods(null, null, ['start' => $start, 'end' => $end]);
            }

            // Llamar a la función privada _print para procesar y mostrar el informe
            $this->_print($query, $table, $date);
        }
    }


    /**
     * Genera un informe en formato PDF con los datos proporcionados.
     *
     * @param array $data Los datos para el informe.
     * @param string $table_ La tabla de origen de los datos ('incoming_goods', 'outgoing_goods', 'outgoing_goods_total').
     * @param string $date La fecha para el informe.
     */
    private function _print($data, $table_, $date)
    {
        // Cargar la biblioteca 'CustomPDF'
        $this->load->library('CustomPDF');

        // Determinar el nombre de la tabla en formato legible
        $table = $table_ == 'incoming_goods' ? 'Productos Entrantes' : 'Productos Salientes';

        // Crear una nueva instancia de FPDF
        $pdf = new FPDF();
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'Reporte : ' . $table, 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190, 4, 'Periodo : ' . $date, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 9);

        // Generar el encabezado de la tabla según la tabla de origen
        if ($table_ == 'incoming_goods') :
            // Encabezado para la tabla de productos entrantes
            $pdf->Cell(10, 7, '#', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Fecha de entrada', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID', 1, 0, 'C');
            $pdf->Cell(55, 7, 'Nombre del producto', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Proveedor', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Cantidad', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, date('d-m-Y', strtotime($d['arrival_date'])), 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_incoming_goods'], 1, 0, 'C');
                $pdf->Cell(55, 7, $d['name_item'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['supplier_name'], 1, 0, 'L');
                $pdf->Cell(30, 7, $d['quantity_in'] . ' ' . $d['unit_name'], 1, 0, 'C');
                $pdf->Ln();
            }
        elseif ($table_ == 'outgoing_goods') :
            // Encabezado para la tabla de productos salientes
            $pdf->Cell(10, 7, '#', 1, 0, 'C');
            $pdf->Cell(18, 7, 'Fecha de salida', 1, 0, 'C');
            $pdf->Cell(30, 7, 'ID', 1, 0, 'C');
            $pdf->Cell(55, 7, 'Nombre del producto', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Destinatario', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Dirección', 1, 0, 'C');
            $pdf->Cell(18, 7, 'Cantidad', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            $grandTotal = 0;
            foreach ($data as $d) {
                $grandTotal += $d['grand_total'];
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(18, 7, date('d-m-Y', strtotime($d['departure_date'])), 1, 0, 'C');
                $pdf->Cell(30, 7, $d['id_outgoing_goods'], 1, 0, 'C');
                $pdf->Cell(55, 7, $d['name_item'], 1, 0, 'L');
                $pdf->Cell(25, 7, $d['recipient_name'], 1, 0, 'L');
                $pdf->Cell(35, 7, $d['address'], 1, 0, 'L');
                $pdf->Cell(18, 7, $d['quantity_out'] . ' ' . $d['unit_name'], 1, 0, 'C');
                $pdf->Ln();
            }
        else :
            // Encabezado para la tabla de productos salientes totales
            $pdf->Cell(7, 7, '#', 1, 0, 'C');
            $pdf->Cell(16, 7, 'Fecha de salida', 1, 0, 'C');
            $pdf->Cell(27, 7, 'ID', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Nombre del producto', 1, 0, 'C');
            $pdf->Cell(24, 7, 'Destinatario', 1, 0, 'C');
            $pdf->Cell(48, 7, 'Dirección', 1, 0, 'C');
            $pdf->Cell(16, 7, 'Cantidad', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Total', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            $grandTotal = 0;
            foreach ($data as $d) {
                $grandTotal += $d['grand_total'];
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(7, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(16, 7, date('d-m-Y', strtotime($d['departure_date'])), 1, 0, 'C');
                $pdf->Cell(27, 7, $d['id_outgoing_goods'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['name_item'], 1, 0, 'L');
                $pdf->Cell(24, 7, $d['recipient_name'], 1, 0, 'L');
                $pdf->Cell(48, 7, $d['address'], 1, 0, 'L');
                $pdf->Cell(16, 7, $d['quantity_out'] . ' ' . $d['unit_name'], 1, 0, 'C');
                $pdf->Cell(25, 7, '$' . number_format($d['grand_total'], 0, ',', '.'), 1, 0, 'L');
                $pdf->Ln();
            }
            // Agregar fila de Total General
            $pdf->Cell(173, 7, 'Total General', 1, 0, 'C');
            $pdf->Cell(25, 7, '$' . number_format($grandTotal, 0, ',', '.'), 1, 0, 'L');
            $pdf->Ln();
        endif;

        // Establecer el nombre del archivo
        $file_name = $table . ' ' . $date;

        // Mostrar el informe en formato PDF en el navegador
        $pdf->Output('I', $file_name);
    }

    /*
    private function _print($data, $table_, $date)
    {
        $this->load->library('CustomPDF');
        $table = $table_ == 'incoming_goods' ? 'Productos Entrantes' : 'Productos Salientes';

        $pdf = new FPDF();
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'Reporte : ' . $table, 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190, 4, 'Periodo : ' . $date, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 9);

        if ($table_ == 'incoming_goods') :
            $pdf->Cell(10, 7, '#', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Fecha de entrada', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID', 1, 0, 'C');
            $pdf->Cell(55, 7, 'Nombre del producto', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Proveedor', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Cantidad', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, date('d-m-Y', strtotime($d['arrival_date'])), 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_incoming_goods'], 1, 0, 'C');
                $pdf->Cell(55, 7, $d['name_item'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['supplier_name'], 1, 0, 'L');
                $pdf->Cell(30, 7, $d['quantity_in'] . ' ' . $d['unit_name'], 1, 0, 'C');
                $pdf->Ln();
            }

        elseif ($table_ == 'outgoing_goods') :
            $pdf->Cell(10, 7, '#', 1, 0, 'C');
            $pdf->Cell(18, 7, 'Fecha de salida', 1, 0, 'C');
            $pdf->Cell(30, 7, 'ID', 1, 0, 'C');
            $pdf->Cell(55, 7, 'Nombre del producto', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Destinatario', 1, 0, 'C');
            $pdf->Cell(35, 7, 'DirecciOn', 1, 0, 'C');
            $pdf->Cell(18, 7, 'Cantidad', 1, 0, 'C');
            // $pdf->Cell(25, 7, 'Total', 1, 0, 'C');

            $pdf->Ln();

            $no = 1;
            $grandTotal = 0;
            foreach ($data as $d) {
                $grandTotal += $d['grand_total'];
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(18, 7, date('d-m-Y', strtotime($d['departure_date'])), 1, 0, 'C');
                $pdf->Cell(30, 7, $d['id_outgoing_goods'], 1, 0, 'C');
                $pdf->Cell(55, 7, $d['name_item'], 1, 0, 'L');
                $pdf->Cell(25, 7, $d['recipient_name'], 1, 0, 'L');
                $pdf->Cell(35, 7, $d['address'], 1, 0, 'L');
                $pdf->Cell(18, 7, $d['quantity_out'] . ' ' . $d['unit_name'], 1, 0, 'C');
                // $pdf->Cell(25, 7, '$'.number_format($d['grand_total'],0,',','.'), 1, 0, 'L');

                $pdf->Ln();
            }
        else :
            $pdf->Cell(7, 7, '#', 1, 0, 'C');
            $pdf->Cell(16, 7, 'Fecha de salida', 1, 0, 'C');
            $pdf->Cell(27, 7, 'ID', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Nombre del producto', 1, 0, 'C');
            $pdf->Cell(24, 7, 'Destinatario', 1, 0, 'C');
            $pdf->Cell(48, 7, 'DirecciOn', 1, 0, 'C');
            $pdf->Cell(16, 7, 'Cantidad', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Total', 1, 0, 'C');

            $pdf->Ln();

            $no = 1;
            $grandTotal = 0;
            foreach ($data as $d) {
                $grandTotal += $d['grand_total'];
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(7, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(16, 7, date('d-m-Y', strtotime($d['departure_date'])), 1, 0, 'C');
                $pdf->Cell(27, 7, $d['id_outgoing_goods'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['name_item'], 1, 0, 'L');
                $pdf->Cell(24, 7, $d['recipient_name'], 1, 0, 'L');
                $pdf->Cell(48, 7, $d['address'], 1, 0, 'L');
                $pdf->Cell(16, 7, $d['quantity_out'] . ' ' . $d['unit_name'], 1, 0, 'C');
                $pdf->Cell(25, 7, '$' . number_format($d['grand_total'], 0, ',', '.'), 1, 0, 'L');

                $pdf->Ln();
            }
            $pdf->Cell(173, 7, 'Total General', 1, 0, 'C');
            $pdf->Cell(25, 7, '$' . number_format($grandTotal, 0, ',', '.'), 1, 0, 'L');
            $pdf->Ln();
        endif;

        $file_name = $table . ' ' . $date;
        $pdf->Output('I', $file_name);
    }
*/
}
