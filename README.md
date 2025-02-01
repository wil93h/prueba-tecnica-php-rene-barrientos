
# Prueba Técnica PHP

Este proyecto es una implementación de una prueba técnica en PHP que consiste en gestionar usuarios a través de un sistema sencillo sin utilizar frameworks. Se implementan las entidades, repositorios, casos de uso y pruebas unitarias para validar el correcto funcionamiento del sistema.

## Estructura del Proyecto

El proyecto está organizado de la siguiente manera:

```
/prueba-tecnica-php-rene-barrientos
├── /docker                # Archivos relacionados con Docker.
│   ├── apache.conf
│   ├── Dockerfile
│   └── init.sql
├── /public                # Carpeta pública para acceso a la aplicación.
│   ├── .htaccess
│   └── index.php
├── /src                   # Código fuente.
│   ├── /Controller        # Controladores.
│   ├── /Database          # Configuración y conexión a la base de datos.
│   ├── /DTO               # Objetos de transferencia de datos.
│   ├── /Entity            # Entidades del dominio.
│   ├── /Repository        # Repositorios e interfaces.
│   └── /UseCase           # Casos de uso.
├── /tests                 # Pruebas unitarias y de integración.
│   ├── /Entity
│   ├── /Repository
│   └── /UseCase
├── .gitignore             # Archivos y carpetas ignoradas por Git.
├── composer.json          # Archivo de configuración de Composer.
├── docker-compose.yml     # Configuración de Docker.
├── phpunit.xml            # Configuración de PHPUnit.
├── README.md              # Este archivo.
```

## Instalación y Ejecución

Sigue los siguientes pasos para poner en marcha el proyecto en tu entorno local utilizando Docker:

### 1. Clona el repositorio

```bash
git clone https://github.com/wil93h/prueba-tecnica-php-rene-barrientos
cd prueba-tecnica-php-rene-barrientos
```

### 2. Construye y levanta los contenedores de Docker

Asegúrate de estar en la raíz del proyecto y ejecuta el siguiente comando para construir y levantar los contenedores de la aplicación y la base de datos:

```bash
docker-compose up --build
```

Este comando creará dos contenedores:

- `php_app`: Contenedor donde se ejecuta la aplicación PHP.
- `mysql_db`: Contenedor con MySQL, preconfigurado con la base de datos `db_users`.


### 3. Accede a la base de datos MySQL

Puedes conectarte a la base de datos con las siguientes credenciales:

- **Host**: `localhost`
- **Usuario**: `user`
- **Contraseña**: `toor`
- **Base de datos**: `db_users`

### 4. Ejecuta las pruebas unitarias

#### Accede al contenedor de PHP

```bash
docker exec -it php_app bash
```

#### Ejecuta todas las pruebas

Navega a la carpeta raíz del proyecto y ejecuta el siguiente comando para correr todas las pruebas de PHPUnit:

```bash
php vendor/bin/phpunit
```

Este comando ejecutará todas las pruebas unitarias y de integración definidas en el proyecto.

---

## Notas adicionales

- El archivo `init.sql` se ejecuta automáticamente cuando se levanta el contenedor de la base de datos, y se utiliza para inicializar la base de datos con datos de ejemplo.
- Puedes realizar cambios en el código fuente de la aplicación directamente desde tu máquina local, ya que está mapeada a la carpeta `/var/www/html` en el contenedor de la aplicación PHP.
- El contenedor de la base de datos guarda su estado en un volumen persistente (`db_data`), por lo que los datos no se perderán al reiniciar los contenedores.
