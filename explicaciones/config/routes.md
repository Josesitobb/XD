## Routes

[Tabla de Contenido](../guía.md#tabla-de-contenido)

El enrutamiento en CodeIgniter 3 es el proceso de definir cómo deben mapearse las URL a controladores específicos y sus métodos. Esto te permite configurar el comportamiento de las URL de tu aplicación web, haciéndolas más amigables para el usuario y expresivas. El sistema de enrutamiento de CodeIgniter es flexible y poderoso, y se define en el archivo de configuración `application/config/routes.php`.

Aquí tienes una explicación de cómo funciona el enrutamiento en CodeIgniter 3:

1. **Configuración de Enrutamiento**:
   - Las reglas de enrutamiento se definen en el archivo `application/config/routes.php`.
   - Este archivo contiene un arreglo asociativo donde especificas las reglas de enrutamiento.

2. **Controlador y Método Predeterminados**:
   - Por defecto, CodeIgniter enruta las solicitudes al controlador `Welcome` y su método `index`.
   - Puedes cambiar el controlador y método predeterminados configurando las opciones de `$route['default_controller']`.

   ```php
   $route['default_controller'] = 'TuControlador';
   ```

3. **Enrutamiento Básico**:
   - La regla de enrutamiento más básica asigna una URL a un controlador y método específicos.
   - Especificas la URL como la clave y el método del controlador como el valor en el arreglo de enrutamiento.

   ```php
   $route['alguna-url'] = 'NombreDelControlador/nombreDelMetodo';
   ```

4. **Sobrescritura de Rutas**:
   - Puedes sobrescribir el comportamiento de enrutamiento predeterminado de CodeIgniter utilizando reglas de enrutamiento personalizadas.
   - Las sobrescrituras de ruta tienen prioridad sobre el comportamiento predeterminado.

   ```php
   $route['blog'] = 'ControladorDelBlog';
   ```

   En este ejemplo, la URL `blog` se enrutaría directamente al `ControladorDelBlog`.

El enrutamiento en CodeIgniter 3 es una herramienta poderosa para personalizar cómo se manejan las URL en tu aplicación web. Te permite crear URL amigables para el usuario y optimizadas para SEO, mapeándolas a controladores y métodos específicos, proporcionando una forma estructurada y organizada de gestionar las rutas de tu aplicación.