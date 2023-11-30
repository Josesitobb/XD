## Estructura del proyecto

[Tabla de Contenido](../guía.md#tabla-de-contenido)

Vamos a analizar la estructura del proyecto:

1. **application/**: Este directorio contiene los componentes principales de la aplicación de CodeIgniter.
   - **config/**: Aquí se almacenan los archivos de configuración.
     - **autoload.php**: Este archivo contiene la lista de bibliotecas, ayudantes y modelos que se deben cargar automáticamente cuando la aplicación inicia.
     - **config.php**: Aquí se encuentran las configuraciones generales de la aplicación.
     - **database.php**: Las configuraciones de la base de datos, incluidos los detalles de la conexión, se almacenan aquí.
     - **routes.php**: Define las rutas URL personalizadas en este archivo.
   - **helpers/**: Aquí pueden ubicarse funciones de ayuda personalizadas.
   - **libraries/**: Las bibliotecas personalizadas pueden ubicarse en este directorio.
   - **third_party/**: Bibliotecas de terceros, complementos o paquetes.
   - **models/**: Por lo general, se almacenan aquí las clases de modelos encargadas de interactuar con la base de datos.
   - **views/**: Aquí se encuentran las plantillas HTML y la lógica de presentación.
   - **controllers/**: Las clases de controladores, que manejan las solicitudes HTTP y procesan datos, deben ubicarse aquí.
   - **sessions/**: Directorio personalizado utilizado para almacenar archivos de sesión.

2. **database_file/**: Este directorio contiene archivos relacionados con la base de datos, como archivos de volcado SQL o archivos de copia de seguridad.

3. **assets/**: Este directorio se utiliza para almacenar los activos estáticos de la aplicación, como CSS, JavaScript, imágenes y otros archivos del lado del cliente.

4. **system/**: Los archivos del sistema de CodeIgniter se encuentran en este directorio. Contiene los componentes principales y las bibliotecas del marco de CodeIgniter. Por lo general, no se modifican ni se agregan archivos a este directorio.

5. **.htaccess**: Este archivo se utiliza con frecuencia para la reescritura de URL y la configuración del servidor, especialmente en servidores web Apache, para crear URL más limpias y amigables para el usuario.

6. **composer.json**: Este archivo se utiliza para gestionar las dependencias con Composer, un administrador de paquetes PHP. Si utiliza paquetes de terceros, es posible que estén definidos en este archivo.

7. **LICENSE.txt**: Este archivo contiene la información de licencia del proyecto.

8. **README.md**: Este es un archivo de readme con formato Markdown en el que puede proporcionar documentación e información sobre su proyecto.