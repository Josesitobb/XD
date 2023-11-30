## Enviar datos a la vista

[Tabla de Contenido](../guía.md#tabla-de-contenido)

**Cómo enviar datos desde el controlador a la vista en CodeIgniter 3**

En CodeIgniter 3, puedes enviar datos desde un controlador a una vista siguiendo estos pasos:

1. **Cargar la Vista:** En primer lugar, debes cargar el archivo de vista. Puedes usar el método `load->view()` para hacerlo. Aquí está la sintaxis básica:

    ```php
    $this->load->view('nombre_vista', $data);
    ```

   - `'nombre_vista'` es el nombre del archivo de vista que deseas cargar (sin la extensión `.php`).
   - `$data` es un parámetro opcional que contiene los datos que deseas enviar a la vista. Puede ser un arreglo o un objeto.

2. **Pasar Datos a la Vista:** Para enviar datos a la vista, simplemente inclúyelos en el arreglo `$data` al cargar la vista. Por ejemplo:

    ```php
    $data = array(
        'titulo' => 'Título de mi página',
        'contenido' => 'Este es algún contenido para mostrar en la vista.'
    );

    $this->load->view('mi_vista', $data);
    ```

3. **Acceder a los Datos en la Vista:** En tu archivo de vista (por ejemplo, `mi_vista.php`), puedes acceder a los datos utilizando variables PHP. Por ejemplo, para mostrar el título y el contenido enviados desde el controlador:

    ```php
    <html>
    <head>
        <title><?php echo $titulo; ?></title>
    </head>
    <body>
        <div>
            <h1><?php echo $contenido; ?></h1>
        </div>
    </body>
    </html>
    ```

   Este código mostrará dinámicamente el título y el contenido en función de los datos enviados desde el controlador.

Siguiendo estos pasos, puedes enviar fácilmente datos desde un controlador a una vista en CodeIgniter 3. Esto te permite crear páginas web dinámicas en las que el contenido puede cambiar según los datos que envíes desde el controlador.