📌 🏠 Soluciones Inmobiliarias

> Sistema integral de gestión inmobiliaria

<!--[Banner del Proyecto](./assets/banner.png)  opcional -->

---

## 🧭 Tabla de Contenidos

<!-- [📌 Título del Proyecto](#-título-del-proyecto)-->
- [🧭 Tabla de Contenidos](#-tabla-de-contenidos)
- [🎯 Descripción General](#-descripción-general)
- [🚀 Características Principales](#-características-principales)
- [📸 Galería de Imágenes](#-galería-de-imágenes)
- [🛠️ Tecnologías Utilizadas](#️-tecnologías-utilizadas)
- [🧪 Instalación y Uso](#-instalación-y-uso)
<!-- [📄 Licencia](#-licencia)
- [👨‍💻 Autor](#-autor)
- [📁 Estructura del Proyecto](#-estructura-del-proyecto)
- [🔐 Autenticación y Seguridad](#-autenticación-y-seguridad)
- [📈 Roadmap / Funcionalidades Futuras](#-roadmap--funcionalidades-futuras)
- [🤝 Contribuciones](#-contribuciones)-->

---

## 🎯 Descripción General

Este proyecto fue desarrollado para un cliente del sector inmobiliario con el objetivo de modernizar la gestión de propiedades y citas.
Incluye visualización de imágenes 360° con navegación mediante hotspots, lo que mejora significativamente la experiencia del usuario.
También permite agendar citas de forma dinámica entre clientes y agentes, facilitando el seguimiento y control de visitas.
La aplicación ofrece una solución integral para mostrar inmuebles, gestionar usuarios y optimizar la atención al cliente.

---

## 🚀 Características Principales

- ✅ Registro y autenticación de usuarios
- 🏘️ Gestión de propiedades con imágenes
- 📅 Agendamiento de citas entre cliente y agente
- 📊 Reportes administrativos descargables
- 🌐 Interfaz responsiva para móviles y escritorio

---

## 🛠️ Tecnologías Utilizadas

- ⚙️ **Framework**: Laravel 12  
- 💬 **Lenguaje**: PHP 8.2  
- 🗄️ **Base de datos**: MySQL  
- 🎨 **Frontend**: Blade + Bootstrap 5  
- 🧠 **Extras**: Eloquent ORM, Artisan CLI

---

## 🧪 Instalación y Uso

```bash
# 1. Clona el repositorio
git clone https://github.com/usuario/repositorio-laravel.git

# 2. Ingresa al directorio
cd repositorio-laravel

# 3. Instala dependencias
composer install

# 4. Copia el archivo de entorno
cp .env.example .env

# 5. Genera la clave de la aplicación
php artisan key:generate

# 6. Configura la conexión a MySQL en el archivo .env
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=nombre_de_base_de_datos
# DB_USERNAME=tu_usuario
# DB_PASSWORD=tu_contraseña

# 7. Ejecuta las migraciones y seeders (opcional)
php artisan migrate --seed

# 8. Ejecuta el Storage
php artisan storage:link

# 9. Levanta el servidor local
php artisan serve
