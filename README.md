# Luis Navas Producciones - Sitio Web

Este proyecto contiene el código fuente del sitio web de Luis Navas Producciones.

## Requisitos

- Docker
- Docker Compose

## Cómo ejecutar el proyecto

1. **Clona este repositorio en tu máquina local.**

2. **Inicia los contenedores de Docker.**
   Abre una terminal en la raíz del proyecto y ejecuta el siguiente comando:
   ```bash
   docker compose up -d
   ```
   Este comando construirá la imagen de la aplicación, iniciará los contenedores del servidor web y la base de datos, y poblará la base de datos con la estructura de las tablas y un usuario administrador por defecto.

3. **Accede al sitio web.**
   Una vez que los contenedores estén en funcionamiento, puedes acceder al sitio web en tu navegador en la siguiente URL:
   [http://localhost:8080](http://localhost:8080)

4. **Accede al panel de administración.**
   Puedes acceder al panel de administración en la siguiente URL:
   [http://localhost:8080/admin](http://localhost:8080/admin)

   **Credenciales del administrador:**
   - **Usuario:** `admin`
   - **Contraseña:** `admin123`

## Estructura del Proyecto

- `luisnavasproducciones/`: Contiene el código fuente de la aplicación PHP.
  - `assets/`: Contiene los archivos estáticos (CSS, JS, imágenes).
  - `admin/`: Contiene las páginas del panel de administración.
  - `includes/`: Contiene los archivos PHP compartidos (header, footer, config).
  - `database.sql`: Contiene la estructura de la base de datos.
- `Dockerfile`: Define la imagen de Docker para el servidor web (Apache + PHP).
- `docker-compose.yml`: Define los servicios de la aplicación (servidor web y base de datos).
- `README.md`: Este archivo.
