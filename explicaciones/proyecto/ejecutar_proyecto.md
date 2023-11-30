## Cómo Ejecutar el Proyecto

[Tabla de Contenido](../guía.md#tabla-de-contenido)

[Tabla de Contenido](../proyecto/../proyecto/../../LICENSE.txt)


Instrucciones para configurar el proyecto.

### Para el equipo de desarrollo

1. Descarga e instala:
    - [WampServer](https://sourceforge.net/projects/wampserver/)
    - o [XAMPP](https://www.apachefriends.org/index.html).
2. **Clonar el Repositorio**:
   - En GitHub Desktop, haz clic en el menú "File" (Archivo) en la esquina superior izquierda.
   - Selecciona "Clone Repository" (Clonar Repositorio).
   - En el campo "URL," pega la URL del repositorio privado proporcionada en la invitación.
   - Elige el directorio local en tu máquina ("www" para WAMP, o "htdocs" para XAMPP) donde deseas guardar el repositorio.
   - Haz clic en el botón "Clone" (Clonar).
3. Abre tu navegador web preferido (se recomienda Google Chrome o Mozilla Firefox).
4. Visita la URL "http://localhost/phpmyadmin."
5. Crea la base de datos importando (en la pestaña "Importar") el archivo de la base de datos ubicado en la carpeta "database_file".
6. Después de completar la configuración de la base de datos, visita la URL "http://localhost/[NOMBRE_DE_LA_CARPETA_DEL_PROYECTO]/" en tu navegador web (reemplaza [NOMBRE_DE_LA_CARPETA_DEL_PROYECTO] con el nombre real de la carpeta del proyecto, por ejemplo, "veico-tools").
7. Utiliza las credenciales de inicio de sesión proporcionadas en la carpeta del proyecto para acceder al sistema.

**Nota**: Si es necesario, puedes editar el archivo `application/config/database.php` para cambiar el nombre de usuario y la contraseña de la conexión a la base de datos (por defecto: 'root', '').

---

### Para otros desarrolladores/usuarios

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