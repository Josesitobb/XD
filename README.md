# Veico Tools - Sistema de Punto de Venta

## Introducción

¡Bienvenido al Sistema de Punto de Venta (POS) de Veico Tools! Este sólido y completamente funcional proyecto de aplicación web utiliza PHP en conjunto con el framework web CodeIgniter para proporcionar una solución integral para gestionar transacciones, cubriendo tanto las mercancías entrantes como las salientes.

## Cómo Ejecutar el Proyecto

Instrucciones para configurar el proyecto utilizando WampServer o XAMPP:

1. Descarga el proyecto y descomprímelo.
2. Descarga e instala:
    - [WampServer](https://sourceforge.net/projects/wampserver/)
    - o [XAMPP](https://www.apachefriends.org/index.html).
3. Encuentra el directorio y busca la carpeta "www" (para WAMP) o la carpeta "htdocs" (para XAMPP).
4. Pega la carpeta descomprimida del proyecto (no el archivo .zip) dentro de la carpeta "www" o "htdocs".
5. Abre tu navegador web preferido (se recomienda Google Chrome o Mozilla Firefox).
6. Visita la URL "http://localhost/phpmyadmin."
7. Crea la base de datos importando (en la pestaña "Importar") el archivo de la base de datos ubicado en la carpeta "database_file".
8. Después de completar la configuración de la base de datos, visita la URL "http://localhost/[NOMBRE_DE_LA_CARPETA_DEL_PROYECTO]/" en tu navegador web (reemplaza [NOMBRE_DE_LA_CARPETA_DEL_PROYECTO] con el nombre real de la carpeta del proyecto, por ejemplo, "veico-tools").
9. Utiliza las credenciales de inicio de sesión proporcionadas en la carpeta del proyecto para acceder al sistema.

**Nota**: Si es necesario, puedes editar el archivo `application/config/database.php` para cambiar el nombre de usuario y la contraseña de la conexión a la base de datos (por defecto: 'root', '').

## Tecnologías y Componentes Utilizados

1. **PHP con CodeIgniter 3**: El backend del proyecto está impulsado por PHP y está estructurado y gestionado utilizando el framework CodeIgniter 3. CodeIgniter proporciona una sólida base para construir aplicaciones web con excelente soporte para enrutamiento, arquitectura MVC e interacciones con bases de datos.

2. **Bootstrap 4**: El frontend del proyecto está diseñado con Bootstrap 4, un framework CSS popular y receptivo. Bootstrap garantiza una interfaz de usuario consistente y visualmente atractiva en diferentes dispositivos y tamaños de pantalla.

3. **FontAwesome**: FontAwesome se utiliza para incorporar íconos vectoriales escalables en la interfaz de usuario del proyecto. Estos íconos mejoran los elementos visuales y mejoran la experiencia del usuario.

4. **Tema sb-admin-2 (startbootstrap.com)**: El proyecto se beneficia del tema sb-admin-2, obtenido de startbootstrap.com. Este tema ofrece un diseño de panel de control limpio y moderno con varios componentes de interfaz de usuario, lo que lo convierte en una excelente opción para construir aplicaciones web con un panel de administración.

5. **Technologies and Modules Utilized**:

   - **Chart.js**: Se emplea Chart.js para crear gráficos y diagramas interactivos y visualmente atractivos. Permite la visualización de datos para proporcionar a los usuarios información y estadísticas.

   - **DateRangePicker.js**: DateRangePicker.js se utiliza para implementar la funcionalidad de selección de rangos de fechas, lo que permite a los usuarios filtrar y analizar datos dentro de rangos de fechas específicos.

   - **DataTable.js**: DataTable.js se utiliza para la representación eficiente de tablas de datos, clasificación y búsqueda. Mejora la presentación y accesibilidad de datos tabulares dentro de la aplicación.

   - **fpdf php**: fpdf se utiliza para generar documentos PDF de forma dinámica. Esta característica permite que el sistema produzca informes imprimibles y facturas.

   - **jQuery**: jQuery es una biblioteca de JavaScript ampliamente utilizada que simplifica la manipulación del DOM, el manejo de eventos y las solicitudes AJAX en aplicaciones web. Facilita la interacción del usuario y la mejora de la experiencia web en general.

6. **WampServer**: WampServer se utiliza como un componente esencial para el entorno de desarrollo. Proporciona un servidor web local que incluye Apache, MySQL y PHP, facilitando la configuración y ejecución del proyecto en un entorno de desarrollo local.

7. **MySQL**: MySQL se emplea como el sistema de gestión de bases de datos relacionales para el proyecto. Se utiliza para almacenar y gestionar datos de manera eficiente, lo que permite al sistema acceder y mantener información crítica.

## Acerca del Proyecto Veico Tools

El Sistema Veico Tools se enfoca en la gestión eficiente del inventario, un seguimiento meticuloso de las mercancías entrantes y salientes, y una serie de características esenciales. Aquí tienes una descripción general de lo que ofrece:

### 1. Gestión de Inventario

Este sistema está diseñado para una gestión de inventario fluida y sin complicaciones. Puedes agregar y dar seguimiento a las mercancías de manera sencilla, incluyendo sus unidades, tipos y otros detalles relevantes. Además, puedes agregar tipos de productos con solo ingresar sus nombres.

### 2. Paneles de Administrador y Empleado

El sistema se divide en dos paneles distintos: el Panel de Administrador y el Panel de Empleado. El Panel de Administrador brinda acceso a todas las funciones del sistema, lo que permite a los administradores gestionar registros de proveedores, unidades y tipos de productos de manera efectiva.

### 3. Gestión de Mercancías

Agregar mercancías al sistema es un proceso simple. Solo tienes que especificar el nombre, seleccionar una unidad, establecer un precio, ¡y listo! Inicialmente, la cantidad se establece en cero, lo que permite a los administradores actualizarla cuando llegue nuevo stock.

### 4. Manejo de Transacciones

El sistema ofrece un proceso de transacción sin problemas. Te permite registrar las mercancías entrantes seleccionando los productos, especificando los proveedores e ingresando las cantidades. Para las mercancías salientes, se aplican rigurosas validaciones para asegurarse de que los artículos con stock insuficiente no puedan procesarse. Completar una venta es sencillo, solo requiere la selección de productos, entrada de cantidad y detalles del cliente (nombre, dirección, descuentos, etc.). El sistema luego calcula el subtotal, el monto total y genera facturas para cada transacción.

### Registros de Transacciones, Gráficos, Informes y Gestión de Usuarios

- **Facturación**: El sistema genera facturas para todas las transacciones, brindando a los usuarios una forma sencilla de verlas e imprimirlas.

- **Visualización de Datos**: Interactúa con tus datos a través de gráficos interactivos que ofrecen información sobre las mercancías entrantes y salientes mensuales, anuales y generales directamente en el panel de control.

- **Informes Detallados**: Los administradores pueden obtener y descargar informes de transacciones que ofrecen un desglose completo de ventas y compras, junto con los montos y fechas respectivas.

- **Gestión de Usuarios**: Administra cuentas de usuario con facilidad, incluyendo la activación y desactivación de cuentas.

### Resumen de Inventario, Transacciones y Ganancias

El panel de control proporciona una instantánea de información esencial, facilitando la gestión de inventario. Incluye alertas para mercancías con cantidades mínimas (menos de 10), muestra las 5 transacciones de compra más recientes y las 5 transacciones de venta más recientes, con fechas, nombres de productos y cantidades. Además, el sistema lleva un registro de las ganancias totales al sumar los valores de los productos vendidos desde el inicio del proyecto hasta la fecha actual.

## Panel de Empleado

Los empleados pueden registrar sus cuentas en el sistema, pero requieren la aprobación del administrador para activar sus cuentas. Una vez activados, los empleados tienen acceso para gestionar productos, proveedores, transacciones y acceder a informes detallados. Notablemente, los empleados no pueden realizar tareas de gestión de usuarios, como activar o desactivar cuentas. Tanto el administrador como los empleados pueden actualizar sus perfiles, incluyendo imágenes de perfil y contraseñas.

## Características Clave

- Panel de Administrador y Panel de Empleado
- Gestión de Proveedores y Configuración de Unidades y Tipos
- Gestión de Mercancías en Inventario
- Mercancías Entrantes (Compras) y Mercancías Salientes (Ventas)
- Descuentos y Generación de Facturas
- Generación de Informes y Configuración de Usuario
- Gestión de Usuarios (Activación/Desactivación)
- Representaciones Gráficas y Seguimiento de Ganancias Totales
- Resumen de Stock de Mercancías Mínimas y Resumen de Transacciones Recientes
