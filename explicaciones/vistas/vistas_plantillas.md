## Vistas y Plantillas

[Tabla de Contenido](../guía.md#tabla-de-contenido)

```php
$this->template->load('plantillas/dashboard', 'productos', $datos);
```

En este ejemplo, estás utilizando una clase de plantilla personalizada (`$this->template`) para cargar una vista. Aquí te explico qué hace cada parte del código:

1. `$this->template`: Esta es una instancia de tu clase de plantilla personalizada, que presumiblemente extiende la clase de controlador de CodeIgniter o está disponible a través de una biblioteca o helper.

2. `load`: Este es un método proporcionado por tu clase de plantilla personalizada para cargar una vista.

3. `'plantillas/dashboard'`: Este es el nombre de la plantilla o diseño que deseas usar para tu vista. Es una referencia a un archivo de vista que define la estructura general de tu página. Típicamente, esta vista contiene la estructura HTML, encabezado, barra lateral y otros elementos comunes de tu sitio web.

4. `'productos'`: Este es el nombre de la vista que deseas cargar en el diseño `'plantillas/tablero'`. Esta vista contendrá el contenido específico de la página de "productos", como listados o detalles de productos.

5. `$datos`: Este es un array u objeto que contiene los datos que deseas pasar a la vista. Estos datos pueden incluir variables que se utilizarán dentro de la vista para mostrar contenido dinámico.

Así es cómo funciona este código en la práctica:

1. CodeIgniter cargará la vista `'plantillas/dashboard'`, que sirve como la plantilla principal para tu página de tablero. Esta plantilla típicamente incluye la estructura HTML, encabezado, pie de página y cualquier otro elemento común compartido en múltiples páginas.

2. Dentro de la vista `'plantillas/dasboard'`, es posible que tengas marcadores de posición o regiones donde se insertará el contenido específico de la página (en este caso, 'productos').

3. CodeIgniter luego cargará la vista `'productos'`, pasando el array `$datos` según sea necesario. Esta vista contiene el contenido específico de la página de 'productos'.

4. La clase de plantilla personalizada combinará el diseño 'plantillas/tablero' con el contenido 'productos' y generará la salida HTML final. Esto asegura una disposición consistente en todo tu sitio web.

5. La página HTML resultante, ahora completamente generada, se enviará como respuesta al navegador del usuario.
