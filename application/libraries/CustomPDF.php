<?php // Done

/**
 * Clase CustomPDF
 *
 * Esta clase actúa como una biblioteca personalizada de PDF para CodeIgniter 3, habilitando la generación de PDF
 * dentro de su aplicación utilizando la biblioteca FPDF.
 *
 * @package     CodeIgniter
 * @subpackage  Bibliotecas
 * @category    Generación de PDF
 */
class CustomPDF
{
    /**
     * Constructor
     *
     * El constructor de la clase CustomPDF incluye la biblioteca FPDF,
     * lo que le permite utilizar su funcionalidad para crear y manipular documentos PDF
     * dentro de su aplicación CodeIgniter.
     */
    public function __construct()
    {
        // Incluir el archivo de biblioteca FPDF desde el directorio de terceros
        include_once APPPATH . '/third_party/fpdf/fpdf.php';
    }
}
