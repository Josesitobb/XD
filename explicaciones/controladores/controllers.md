## Controllers

[Tabla de Contenido](../guía.md#tabla-de-contenido)

En CodeIgniter 3, los controladores son una parte esencial de la arquitectura MVC (Modelo-Vista-Controlador), que es un patrón de diseño popular utilizado en desarrollo web para separar la lógica de la aplicación en diferentes componentes. Los controladores en CodeIgniter son responsables de manejar las solicitudes HTTP entrantes, procesarlas y controlar el flujo de la aplicación.

Aquí tienes una explicación de los controladores en CodeIgniter 3:

1. **Conceptos Básicos de Controladores**:
   - Los controladores son clases PHP que extienden la clase `CI_Controller` proporcionada por CodeIgniter.
   - Cada controlador corresponde a una sección específica o funcionalidad de tu aplicación web.

2. **Manejo de Solicitudes**:
   - Los controladores manejan las solicitudes HTTP entrantes. Cuando un usuario accede a una URL, CodeIgniter enruta esa solicitud al método del controlador apropiado según la estructura de la URL.

3. **Convención de Nombres de Controladores**:
   - Los nombres de clase de controlador deben estar en mayúsculas y terminar con la palabra "Controller". Por ejemplo, si tienes un controlador para gestionar las publicaciones de un blog, podrías nombrarlo `BlogController`.

4. **Ubicación de Archivos de Controlador**:
   - Los controladores generalmente se almacenan en el directorio `application/controllers` de tu proyecto CodeIgniter.

5. **Métodos de Controlador**:
   - Los métodos de controlador son responsables de realizar acciones específicas según la solicitud entrante.
   - Cada método de controlador corresponde a una URL o ruta específica.
   - Estos métodos pueden interactuar con modelos para obtener datos, procesarlos y pasarlos a vistas para su renderización.

6. **Ejemplo de Clase de Controlador**:
   ```php
   <?php
   // application/controllers/BlogController.php
   class BlogController extends CI_Controller {
       public function index() {
           // Manejar la vista predeterminada del blog
           $this->load->view('blog/index');
       }

       public function view($post_id) {
           // Manejar la visualización de una publicación específica del blog
           // Cargar datos desde un modelo, procesarlos y pasarlos a una vista
           $data['post'] = $this->BlogModel->get_post($post_id);
           $this->load->view('blog/view', $data);
       }

       // Otros métodos de controlador para crear, editar o eliminar publicaciones
   }
   ```

7. **Carga de Vistas**:
   - Los controladores a menudo cargan vistas para generar la salida HTML que se envía de vuelta al navegador del usuario. Las vistas generalmente se encuentran en el directorio `application/views`.

8. **Enrutamiento**:
   - El sistema de enrutamiento de CodeIgniter asigna las URL a métodos de controlador. Puedes configurar reglas de enrutamiento en el archivo `application/config/routes.php`.

9. **Carga de Modelos y Bibliotecas**:
   - Los controladores pueden cargar modelos y bibliotecas para interactuar con bases de datos, realizar validaciones u otras tareas. Puedes cargar estos recursos usando `$this->load->model('NombreDelModelo')` o `$this->load->library('NombreDeLaBiblioteca')`.

10. **Estructura de URL**:
    - La estructura de URL suele seguir un patrón como `http://ejemplo.com/controlador/metodo/parametros`, donde `controlador` se mapea al nombre de la clase de controlador, `metodo` se mapea al método del controlador y `parametros` son opcionales y se pasan como segmentos de URL.

En resumen, los controladores en CodeIgniter 3 desempeñan un papel crucial en la gestión de la lógica y el flujo de tu aplicación web. Manejan las solicitudes entrantes, interactúan con modelos y bibliotecas, cargan vistas y ayudan a mantener una separación limpia de preocupaciones en tu aplicación utilizando la arquitectura MVC.