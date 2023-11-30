<?php // Done

/**
 * Clase Template
 *
 * Esta clase proporciona un sistema de plantillas simple para aplicaciones CodeIgniter 3.
 * Le permite establecer variables de plantilla y cargar vistas dentro de plantillas.
 */
class Template
{
    /**
     * Contiene variables de datos de plantilla.
     *
     * @var array
     */
    var $template_data = [];

    /**
     * Establece una variable de plantilla.
     *
     * @param string $name El nombre de la variable de plantilla.
     * @param mixed $value El valor que se asignará a la variable de plantilla.
     */
    function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }

    /**
     * Carga una vista dentro de una plantilla.
     *
     * @param string $template El nombre de la vista de plantilla para cargar.
     * @param string $view El nombre del archivo de vista para incrustar en la plantilla.
     * @param array $view_data Un array de datos para pasar a la vista incrustada.
     * @param bool $return Si devolver la salida como una cadena o no.
     * @return mixed La salida de la vista de plantilla.
     */
    function load($template = '', $view = '', $view_data = [], $return = false)
    {
        // Obtener la instancia de CodeIgniter
        $this->CI = &get_instance();

        // Establecer la variable de plantilla 'contents' con el resultado de cargar la vista incrustada
        $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));

        // Cargar la vista de plantilla con los datos de la plantilla
        return $this->CI->load->view($template, $this->template_data, $return);
    }
}
