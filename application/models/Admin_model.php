<?php // Done.
defined('BASEPATH') or exit('No direct script access allowed');

/** 
 * La clase `Admin_model` actúa como un modelo en una aplicación web basada en CodeIgniter y 
 * se encarga de gestionar diversas operaciones de base de datos y tareas de recuperación de 
 * datos relacionadas con la sección de administración de la aplicación. Encapsula una amplia 
 * variedad de funciones, cada una con propósitos específicos, relacionados con la administración 
 * e interacción con la base de datos.
 * 
 * 1. **Funciones de Recuperación de Datos:**
 *  - `get`: Recupera datos de una tabla especificada basada en condiciones especificadas.
 *  - `getIncomingGoods`: Recupera datos de mercancías entrantes con filtrado y límite opcionales.
 *  - `getIncomingGoodsDashboard`: Recupera datos de mercancías entrantes específicamente para una vista de panel de control.
 *  - `getOutgoingGoods`: Recupera datos de mercancías salientes con filtrado y límite opcionales.
 *  - `getOutgoingGoodsByID` y `getOutgoingGoodsByID2`: Recuperan datos de mercancías salientes por el ID de mercancía saliente.
 *  - `findOutgoingGoodsByID`: Encuentra datos de mercancías salientes por el ID de mercancía saliente.
 *  - `getItem`: Recupera detalles de un artículo por su ID.
 * 
 * 2. **Funciones de Modificación de Datos:**
 *  - `update`: Actualiza un registro en una tabla especificada.
 *  - `insert`: Inserta datos en una tabla especificada, con opción para inserción por lotes.
 *  - `delete`: Elimina un registro de una tabla especificada.
 *  - `saveCart`: Guarda datos del carrito en la tabla 'outgoing_goods_detail'.
 *  - `actualizar_inventario`: Actualiza información de inventario para un artículo específico. 
 *  - `checkStock`: Verifica información de stock para un artículo específico por su ID.
 * 
 * 3. **Funciones de Agregación de Datos:**
 *  - `get_users`: Recupera una lista de usuarios, excluyendo a un usuario específico.
 *  - `get_items`: Recupera una lista de artículos con información relacionada adicional.
 *  - `getMaxValue`: Recupera el valor máximo de un campo en una tabla con un filtro de código opcional.   
 *  - `countRecords`: Cuenta el número total de registros en una tabla.
 *  - `calculateSum`: Calcula la suma de un campo en una tabla.
 *  - `findRecordsWhereMin`: Encuentra registros en una tabla donde un campo especificado es menor o igual a un valor dado.
 *  - `countIncomingGoods` y `countOutgoingGoods`: Cuenta la cantidad de mercancías entrantes o salientes para un mes específico.
 * 
 * 4. **Funciones de Informes:**
 *  - `generateGoodsReport`: Genera un informe de mercancías basado en la tabla especificada, fecha de inicio y fecha de finalización.
 * 
 * En resumen, el `Admin_model` es una parte crucial de la lógica del backend de la aplicación,
 * facilitando la recuperación, modificación, agregación e informes de datos para fines administrativos. 
 * Abstrae interacciones complejas con la base de datos, lo que facilita la gestión y el mantenimiento 
 * de tareas relacionadas con datos en la sección de administración de la aplicación.
 */
class Admin_model extends CI_Model
{

    /**
     * Recuperar datos de una tabla basados en condiciones especificadas.
     *
     * @param string $table El nombre de la tabla.
     * @param array|null $data Las condiciones para la consulta (pueden ser nulas si se usa $where).
     * @param array|null $where Condiciones adicionales para la consulta (pueden ser nulas si se usa $datos).
     *
     * @return array Un array que contiene los datos recuperados (una sola fila o múltiples filas).
     */
    public function get($table, $data = null, $where = null)
    {
        if ($data !== null) {
            // Recuperar una sola fila de datos basada en las condiciones de $datos.
            return $this->db->get_where($table, $data)->row_array();
        } else {
            // Recuperar múltiples filas de datos basadas en las condiciones de $where.
            return $this->db->get_where($table, $where)->result_array();
        }
    }


    /**
     * Actualizar un registro en la tabla especificada.
     *
     * @param string $table El nombre de la tabla.
     * @param string $pk El nombre de la columna de clave primaria.
     * @param mixed $id El valor de la clave primaria del registro a actualizar.
     * @param array $data Los datos a actualizar en el registro.
     *
     * @return bool True si la operación de actualización fue exitosa; de lo contrario, false.
     */
    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        // Actualizar el registro en la tabla especificada con los datos proporcionados.
        return $this->db->update($table, $data);
    }


    /**
     * Insertar datos en la tabla especificada.
     *
     * @param string $table El nombre de la tabla.
     * @param array $data Los datos para insertar en la tabla.
     * @param bool $batch Si se debe realizar una inserción por lotes (el valor predeterminado es false).
     *
     * @return bool True si la operación de inserción fue exitosa; de lo contrario, false.
     */
    public function insert($table, $data, $batch = false)
    {
        // Realiza una inserción por lotes si $lote es true; de lo contrario, inserta un solo registro.
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }


    /**
     * Eliminar un registro de la tabla especificada basado en la clave primaria.
     *
     * @param string $table El nombre de la tabla.
     * @param string $pk El nombre de la columna de clave primaria.
     * @param mixed $id El valor de la clave primaria del registro a eliminar.
     *
     * @return bool True si la operación de eliminación fue exitosa; de lo contrario, false.
     */
    public function delete($table, $pk, $id)
    {
        // Elimina el registro de la tabla especificada basado en la clave primaria y su valor.
        return $this->db->delete($table, [$pk => $id]);
    }


    /**
     * Actualizar información de inventario para un artículo específico.
     *
     * @param int $id_item El ID del artículo.
     * @param array $data Los datos a actualizar en la tabla 'artículo'.
     */
    public function update_stock($id_item, $data)
    {
        // Establecer la condición 'where' para identificar el artículo por su ID.
        $this->db->where('id_item', $id_item);

        // Realizar la operación de actualización en la tabla 'artículo' utilizando los datos proporcionados.
        $this->db->update('item', $data);
    }


    /**
     * Obtener una lista de usuarios excluyendo al usuario especificado.
     *
     * @param int $id El ID del usuario a excluir de la lista.
     * @return array Un array que contiene los datos de usuario de todos los usuarios excepto el especificado.
     */
    public function get_users($id)
    {
        /**
         * Aquí, 'ID' se usa para excluir datos de la visualización.
         * En otras palabras, se utiliza para ocultar los datos del usuario especificado.
         * Esto se aplica típicamente en la gestión de usuarios para evitar mostrar al usuario que está actualmente conectado.
         */
        // Establecer la condición 'where' para excluir al usuario con el ID especificado.
        $this->db->where('id_user !=', $id);

        // Recuperar los datos de usuario de la tabla 'usuario'.
        return $this->db->get('user')->result_array();
    }


    /**
     * Obtener una lista de artículos con información adicional de tablas relacionadas.
     *
     * @return array Un array que contiene los datos de los artículos con información relacionada.
     */
    public function get_items()
    {
        // Unir las tablas 'categoria' y 'unidad' para obtener información adicional.
        $this->db->join('category c', 'i.id_category = c.id_category');
        $this->db->join('unit u', 'i.id_unit = u.id_unit');

        // Ordenar los resultados por el ID del artículo.
        $this->db->order_by('id_item');

        // Recuperar los datos de los artículos de la tabla 'artículo' con información unida.
        return $this->db->get('item i')->result_array();
    }


    /**
     * Obtener datos de mercancías entrantes con filtrado y límite opcionales.
     *
     * @param int|null $limit La cantidad máxima de registros para recuperar (opcional).
     * @param int|null $id_item El ID del artículo específico para filtrar (opcional).
     * @param array|null $range El rango de fechas para filtrar (opcional).
     * @return array Un array que contiene datos de mercancías entrantes con filtros opcionales aplicados.
     */
    public function getIncomingGoods($limit = null, $id_item = null, $range = null)
    {
        // Seleccionar todas las columnas de la tabla 'mercancias_entrantes'.
        $this->db->select('*');

        // Unir tablas relacionadas para obtener información adicional.
        $this->db->join('user u', 'ig.id_user = u.id_user');
        $this->db->join('supplier s', 'ig.id_supplier = s.id_supplier');
        $this->db->join('item i', 'ig.id_item = i.id_item');
        $this->db->join('unit un', 'i.id_unit = un.id_unit');

        // Aplicar filtrado opcional basado en los parámetros proporcionados.

        // Limitar la cantidad de registros si se proporciona el parámetro 'limit'.
        if ($limit != null) {
            $this->db->limit($limit);
        }

        // Filtrar por un ID de artículo específico si se proporciona el parámetro 'id_item'.
        if ($id_item != null) {
            $this->db->where('id_item', $id_item);
        }

        // Filtrar por un rango de fechas si se proporciona el parámetro 'range'.
        if ($range != null) {
            // Filtrar donde 'arrival_date' sea mayor o igual a la fecha de inicio.
            $this->db->where('arrival_date >=', $range['start']);
            // Filtrar donde 'arrival_date' sea menor o igual a la fecha de finalización.
            $this->db->where('arrival_date <=', $range['end']);
        }

        // Ordenar los resultados por 'id_mercancias_entrantes' en orden descendente.
        $this->db->order_by('id_incoming_goods', 'DESC');

        // Recuperar datos de mercancías entrantes con filtros opcionales aplicados.
        return $this->db->get('incoming_goods ig')->result_array();
    }


    /**
     * Obtener datos de mercancías entrantes para el panel de control.
     *
     * @param int|null $limit El número máximo de registros para recuperar (opcional).
     * @param array|null $range El filtro de rango de fechas (opcional).
     * @return array Un arreglo que contiene datos de mercancías entrantes con información adicional.
     */
    public function getIncomingGoodsDashboard($limit = null, $range = null)
    {
        // Seleccionar todas las columnas de la tabla 'outgoing_goods_details'.
        $this->db->select('*');

        // Unir tablas relacionadas para obtener información adicional.
        $this->db->join('outgoing_goods og', 'og.id_outgoing_goods = ogd.id_outgoing_goods');
        $this->db->join('user u', 'og.id_user = u.id_user');
        $this->db->join('item i', 'ogd.id_item = i.id_item');
        $this->db->join('unit un', 'i.id_unit = un.id_unit');

        // Verificar si se especifica un límite y aplicarlo a la consulta.
        if ($limit != null) {
            $this->db->limit($limit);
        }

        // Verificar si se especifica un filtro de rango de fechas y aplicarlo a la consulta.
        if ($range != null) {
            $this->db->where('departure_date' . ' >=', $range['start']);
            $this->db->where('departure_date' . ' <=', $range['end']);
        }

        // Ordenar los resultados por 'id_detail' en orden descendente.
        $this->db->order_by('ogd.id_detail', 'DESC');

        // Ejecutar la consulta y devolver los resultados como un arreglo.
        return $this->db->get('outgoing_goods_detail ogd')->result_array();
    }


    /**
     * Recuperar datos de mercancías salientes.
     *
     * @param int|null $limit El número máximo de registros para recuperar (opcional).
     * @param array|null $range El filtro de rango de fechas (opcional).
     * @return array Un arreglo que contiene datos de mercancías salientes con información adicional.
     */
    public function getOutgoingGoods($limit = null, $range = null)
    {
        // Seleccionar todas las columnas de la tabla 'outgoing_goods_details'.
        $this->db->select('*');

        // Unir tablas relacionadas para obtener información adicional.
        $this->db->join('outgoing_goods og', 'og.id_outgoing_goods = ogd.id_outgoing_goods');
        $this->db->join('item i', 'ogd.id_item = i.id_item');
        $this->db->join('unit u', 'i.id_unit = u.id_unit');

        // Verificar si se especifica un límite y aplicarlo a la consulta.
        if ($limit != null) {
            $this->db->limit($limit);
        }

        // Verificar si se especifica un filtro de rango de fechas y aplicarlo a la consulta.
        if ($range != null) {
            $this->db->where('departure_date' . ' >=', $range['start']);
            $this->db->where('departure_date' . ' <=', $range['end']);
        }

        // Ordenar los resultados por 'id_detail' en orden descendente.
        $this->db->order_by('ogd.id_detail', 'DESC');

        // Ejecutar la consulta y devolver los resultados como un arreglo.
        return $this->db->get('outgoing_goods_detail ogd')->result_array();
    }


    /**
     * Obtener datos de mercancías salientes por ID de mercancía saliente.
     *
     * @param int $id_outgoing_goods El ID de la mercancía saliente.
     * @return array|null Un arreglo que contiene datos de mercancías salientes con información adicional, o null si no se encuentra.
     */
    public function getOutgoingGoodsByID($id_outgoing_goods)
    {
        // Seleccionar todas las columnas de la tabla 'outgoing_goods'.
        $this->db->select('*');

        $this->db->join('user u', 'og.id_user = u.id_user');
        $this->db->join('item i', 'og.id_item = i.id_item');
        $this->db->join('category c', 'i.id_category = c.id_category');
        $this->db->join('unit un', 'i.id_unit = un.id_unit');

        // Verificar si se proporciona un ID específico de mercancía saliente.
        $this->db->where('og.id_outgoing_goods', $id_outgoing_goods);

        // Ordenar los resultados por 'id_outgoing_goods' en orden descendente.
        $this->db->order_by('og.id_outgoing_goods', 'DESC');

        // Ejecutar la consulta y devolver el resultado.
        return $this->db->get('outgoing_goods og');
    }


    /**
     * Obtener datos de mercancías salientes por ID de mercancía saliente.
     *
     * @param int $id_outgoing_goods El ID de la mercancía saliente.
     * @return array|null Un arreglo que contiene datos de mercancías salientes con información adicional, o null si no se encuentra.
     */
    public function getOutgoingGoodsByID2($id_outgoing_goods)
    {
        // Seleccionar todas las columnas de la tabla 'outgoing_goods_detail'.
        $this->db->select('*');

        $this->db->join('outgoing_goods og', 'og.id_outgoing_goods = ogd.id_outgoing_goods');
        $this->db->join('user u', 'og.id_user = u.id_user');
        $this->db->join('item i', 'ogd.id_item = i.id_item');
        $this->db->join('category c', 'i.id_category = c.id_category');
        $this->db->join('unit un', 'i.id_unit = un.id_unit');

        // Verificar si se proporciona un ID específico de mercancía saliente.
        $this->db->where('og.id_outgoing_goods', $id_outgoing_goods);

        // $this->db->order_by('id_outgoing_goods og', 'DESC');

        // Ejecutar la consulta y devolver el resultado.
        return $this->db->get('outgoing_goods_detail ogd');
    }


    /**
     * Encontrar datos de mercancías salientes por ID de mercancía saliente.
     *
     * @param int $id El ID de la mercancía saliente que se busca.
     * @return array Un arreglo que contiene datos de mercancías salientes, o un arreglo vacío si no se encuentra.
     */
    public function findOutgoingGoodsByID($id)
    {
        // Construir una consulta para recuperar mercancías salientes por ID de la tabla 'outgoing_goods'.
        $query = $this->db->where('id_outgoing_goods', $id)->get('outgoing_goods');

        // Verificar si la consulta devolvió resultados.
        if ($query->num_rows() > 0) {
            // Devolver los datos de mercancías salientes como un arreglo.
            return $query->row_array();
        } else {
            // Devolver un arreglo vacío si no se encontraron mercancías salientes.
            return array();
        }
    }


    /**
     * Guardar datos del carrito en la tabla 'outgoing_goods_detail'.
     *
     * @param int $outgoingGoodsID El ID de la mercancía saliente.
     * @return bool Verdadero en caso de éxito, falso en caso de fallo.
     */
    public function saveCart($outgoingGoodsID)
    {
        // Recorrer cada artículo en el carrito.
        foreach ($this->cart->contents() as $item) {
            // Preparar los datos a insertar en la tabla 'outgoing_goods_detail'.
            $data = array(
                'id_outgoing_goods'     => $outgoingGoodsID,
                'id_item'               => $item['id'],
                'price'                 => $item['amount'],
                'quantity_out'          => $item['qty'],
                'total_detail_amount'   => $item['subtotal']
            );

            // Insertar los datos en la tabla 'outgoing_goods_detail'.
            $this->db->insert('outgoing_goods_detail', $data);

            // Opcionalmente, actualizar la cantidad de stock del artículo correspondiente.
            // $this->db->query("UPDATE tbl_items SET stock_quantity = stock_quantity - $item['qty'] WHERE item_id = $item['id']");
        }

        // Devolver verdadero para indicar éxito.
        return true;
    }


    /**
     * Obtener detalles del artículo por ID de la tabla 'items'.
     *
     * @param int $itemID El ID del artículo a recuperar.
     * @return mixed Un objeto que contiene los detalles del artículo o false si no se encuentra.
     */
    public function getItem($itemID)
    {
        // Consulta SQL
        $query = $this->db->query("SELECT * FROM item WHERE id_item = '$itemID'");
        // return $query;
        return $query->row(); // Utilice ->row() para devolver una sola fila como un objeto.
    }


    /**
     * Obtener el valor máximo de un campo de una tabla con un filtro de código opcional.
     *
     * @param string $table El nombre de la tabla.
     * @param string $field El campo para encontrar el valor máximo.
     * @param string $code Un filtro de código opcional.
     * @return mixed El valor máximo o null si no hay resultados.
     */
    public function getMaxValue($table, $field, $code = null)
    {
        $this->db->select_max($field);
        if ($code != null) {
            $this->db->like($field, $code, 'after');
        }
        // return $this->db->get($table)->row_array()[$field];
        $result = $this->db->get($table)->row_array();
        return $result[$field] ?? null; // Use el operador de fusión nula para manejar valores nulos
    }


    /**
     * Contar el número total de registros en una tabla.
     *
     * @param string $table El nombre de la tabla.
     * @return int El número total de registros.
     */
    public function countRecords($table)
    {
        return $this->db->count_all($table);
    }


    /**
     * Calcular la suma de un campo en una tabla.
     *
     * @param string $table El nombre de la tabla.
     * @param string $field El campo para calcular la suma.
     * @return float La suma del campo.
     */
    public function calculateSum($table, $field)
    {
        $this->db->select_sum($field);
        // return $this->db->get($table)->row_array()[$field];
        $result = $this->db->get($table)->row_array();
        return (float)$result[$field]; // Convertir el resultado a float para sumas precisas.
    }


    /**
     * Encontrar registros en una tabla donde el campo especificado es menor o igual a un valor dado.
     *
     * @param string $table El nombre de la tabla.
     * @param string $field El campo para filtrar.
     * @param int $min El valor mínimo para filtrar los registros.
     * @return array Un array de registros que cumplen con los criterios.
     */
    public function findRecordsWhereMin($table, $field, $min)
    {
        $field = $field . ' <=';
        $this->db->where($field, $min);
        return $this->db->get($table)->result_array();
    }


    /**
     * Contar la cantidad de mercancías entrantes para un mes específico en el año actual.
     *
     * @param string $month El mes para contar las mercancías entrantes (por ejemplo, '01' para enero).
     * @return int La cantidad de mercancías entrantes para el mes especificado en el año actual.
     */
    public function countIncomingGoods($month)
    {
        // Obtener el año actual.
        $currentYear = date('Y');
        // Calcular la fecha formateada para el mes especificado y el año actual (por ejemplo, '2023-01').
        $formattedMonth = date('Y-m', strtotime("$currentYear-$month-01"));
        // Establecer una condición para filtrar registros con 'arrival_date' que coincida con el mes y el año especificados.
        $this->db->where("DATE_FORMAT(arrival_date, '%Y-%m') =", $formattedMonth);
        // Ejecutar la consulta de base de datos para recuperar registros coincidentes.
        $result = $this->db->get('incoming_goods')->result_array();
        // Contar la cantidad de registros en el resultado (que representa la cantidad de mercancías entrantes).
        return count($result);
    }


    /**
     * Contar la cantidad de mercancías salientes para un mes específico en el año actual.
     *
     * @param string $month El mes para contar las mercancías salientes (por ejemplo, '01' para enero).
     * @return int La cantidad de mercancías salientes para el mes especificado en el año actual.
     */
    public function countOutgoingGoods($month)
    {
        // Obtener el año actual.
        $currentYear = date('Y');
        // Calcular la fecha formateada para el mes especificado y el año actual (por ejemplo, '2023-01').
        $formattedMonth = date('Y-m', strtotime("$currentYear-$month-01"));
        // Establecer una condición para filtrar registros con 'arrival_date' que coincida con el mes y el año especificados.
        $this->db->where("DATE_FORMAT(departure_date, '%Y-%m') =", $formattedMonth);
        // Ejecutar la consulta de base de datos para recuperar registros coincidentes.
        $result = $this->db->get('outgoing_goods')->result_array();
        // Contar la cantidad de registros en el resultado (que representa la cantidad de mercancías entrantes).
        return count($result);
    }


    /**
     * Generar un informe de mercancías basado en la tabla especificada, fecha de inicio y fecha de finalización.
     *
     * @param string $table El nombre de la tabla (por ejemplo, 'mercancias_entrantes' o 'mercancias_salientes').
     * @param string $start La fecha de inicio en formato 'Y-m-d'.
     * @param string $end La fecha de finalización en formato 'Y-m-d'.
     * @return array Un array de registros de mercancías dentro del rango de fechas especificado.
     */
    public function generateGoodsReport($table, $start, $end)
    {
        // TODO: edit tables to use 'date_received' : 'date_delivered' instead ?
        $dateColumn = ($table === 'incoming_goods') ? 'arrival_date' : 'departure_date';
        $this->db->where("$dateColumn >=", $start); // Filtrar registros por fecha de inicio.
        $this->db->where("$dateColumn <=", $end); // Filtrar registros por fecha de finalización.
        return $this->db->get($table)->result_array(); // Obtener los registros filtrados.
    }


    /**
     * Verificar la información de stock para un artículo específico por su ID.
     *
     * @param int $id El ID del artículo para verificar el stock.
     * @return array La información de stock del artículo, incluyendo su unidad.
     */
    public function checkStock($id)
    {
        // Unir la tabla 'unidad' para obtener información de la unidad.
        $this->db->join('unit u', 'i.id_unit = u.id_unit');
        // Obtener la información de stock del artículo.
        return $this->db->get_where('item i', ['id_item' => $id])->row_array();
    }
}
