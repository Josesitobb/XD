## Autoload

[Tabla de Contenido](../guía.md#tabla-de-contenido)

En CodeIgniter 3, la función "autoload" te permite especificar qué bibliotecas, ayudantes, modelos y otros recursos se cargarán automáticamente cuando tu aplicación se inicie, sin necesidad de cargarlos explícitamente en cada controlador o método donde los necesites. Esta función simplifica el proceso de inicialización y garantiza que los componentes esenciales estén disponibles en toda tu aplicación.

Aquí tienes una explicación de cómo usar la función de autoload en CodeIgniter 3:

1. **Archivo de Configuración de Autoload**:
   - El archivo de configuración de autoload se encuentra en el directorio `application/config` y se llama `autoload.php`.
   - Puedes abrir y editar este archivo para definir qué se debe cargar automáticamente.

2. **Cargar Bibliotecas automáticamente**:
   - Para cargar bibliotecas automáticamente, agrega sus nombres al arreglo `$autoload['libraries']` en el archivo `autoload.php`.
   - Las bibliotecas suelen utilizarse para funcionalidades comunes como el acceso a bases de datos, sesiones y validación de formularios.

   Ejemplo:
   ```php
   $autoload['libraries'] = array('database', 'session');
   ```

3. **Cargar Ayudantes automáticamente**:
   - Los ayudantes son funciones de utilidad que pueden cargarse automáticamente para mayor comodidad.
   - Agrega los nombres de los ayudantes que deseas cargar automáticamente al arreglo `$autoload['helper']`.

   Ejemplo:
   ```php
   $autoload['helper'] = array('url', 'form');
   ```

4. **Cargar Modelos automáticamente**:
   - También puedes cargar automáticamente modelos que utilices con frecuencia en tu aplicación.
   - Agrega los nombres de los modelos al arreglo `$autoload['model']`.

   Ejemplo:
   ```php
   $autoload['model'] = array('user_model', 'product_model');
   ```

5. **Cargar Recursos Personalizados automáticamente**:
   - Si tienes bibliotecas, ayudantes o otros recursos personalizados que deseas cargar automáticamente, puedes especificarlos en los arreglos `$autoload['libraries']` y `$autoload['helper']`, respectivamente.

6. **Cargar Componentes Adicionales**:
   - Incluso después de habilitar el autoload para ciertos componentes, aún puedes cargar manualmente recursos adicionales en controladores o métodos específicos si es necesario.

   Ejemplo:
   ```php
   $this->load->library('email'); // Cargar manualmente la biblioteca de correo electrónico en un método específico del controlador.
   ```

7. **Configuración de Autoload**:
   - También puedes cargar archivos de configuración automáticamente agregándolos al arreglo `$autoload['config']`.
   - Estos archivos de configuración se cargan automáticamente al iniciar tu aplicación.

   Ejemplo:
   ```php
   $autoload['config'] = array('email', 'custom');
   ```

8. **Mejores Prácticas para el Autoload**:
   - Aunque el autoload puede ser conveniente, es fundamental utilizarlo con prudencia para evitar una sobrecarga innecesaria.
   - Solo carga automáticamente los recursos que se utilizan de manera constante en toda tu aplicación.

Configurando el archivo autoload.php, puedes especificar qué bibliotecas, ayudantes, modelos y archivos de configuración se cargarán automáticamente al iniciar tu aplicación CodeIgniter. Esto puede simplificar tu código y garantizar que los componentes esenciales estén disponibles de inmediato donde los necesites en tu aplicación.