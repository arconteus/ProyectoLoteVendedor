# Arquitectura del Proyecto

Este proyecto utiliza una arquitectura basada en Laravel para el backend y Vue 3 para el frontend, integrados mediante Vite.

## Estructura de Carpetas Principal

- **app/**: Lógica de la aplicación (controladores, modelos, servicios, políticas, proveedores).
- **routes/**: Definición de rutas web y API.
- **resources/views/**: Vistas Blade para el frontend tradicional.
- **resources/js/**: Componentes y lógica de Vue 3.
- **database/**: Migraciones, seeders y factories para la base de datos.
- **public/**: Archivos públicos y punto de entrada de la aplicación.
- **config/**: Archivos de configuración de Laravel.

## Componentes Principales

- **Controladores**: Gestionan la lógica de negocio y reciben las peticiones HTTP.
- **Modelos**: Representan las entidades y gestionan la interacción con la base de datos.
- **Servicios**: Encapsulan lógica de negocio reutilizable y operaciones complejas.
- **Requests**: Validan y autorizan las peticiones entrantes.
- **Policies**: Definen reglas de autorización para los recursos.

## Flujo de Datos

1. El usuario interactúa con la interfaz (Vue o Blade).
2. Las acciones del usuario generan peticiones HTTP a rutas definidas en Laravel.
3. Las rutas llaman a controladores, que validan y procesan la información.
4. Los controladores utilizan modelos y servicios para acceder o modificar datos.
5. La respuesta se envía al frontend, que la muestra al usuario.

## Tecnologías Utilizadas

- Laravel 12 (backend, API REST, autenticación, migraciones)
- Vue 3 (frontend, componentes)
- Vite (empaquetador y recarga en caliente)
- PHP 8.2+
- MySQL o SQLite (base de datos)

## Autenticación y Autorización

La autenticación se gestiona con Laravel Sanctum. Las políticas y middleware controlan el acceso a los recursos según el rol del usuario.
