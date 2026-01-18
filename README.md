# Proyecto Lote-Vendedor

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![Status](https://img.shields.io/badge/Status-In%20Development-orange?style=for-the-badge)
![Version](https://img.shields.io/badge/Version-indev.0.1.0-blue?style=for-the-badge)

## Descripción

Proyecto de prueba creado para experimentar con **Laravel 12** y **Vue 3**, enfocado en la gestión básica de lotes y vendedores.  
El proyecto funciona como un entorno de testeo para explorar la integración de frontend y backend mediante **Vite**, así como el uso de **Sass** y buenas prácticas de organización.

## Requisitos

Antes de descargar este proyecto asegurese de contar con:

- PHP **8.2 o superior**
- Composer
- Node.js **LTS**
- npm
- Servidor local (XAMPP, Laragon o similar)
- Git

## Instalación

git clone https://github.com/tu-usuario/tu-repo.git
cd tu-repo

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

npm run dev
php artisan serve

## Usuario de Prueba

Email: admin@test.com  
Password: password

## Funcionalidades

- Autenticación de usuarios (Login y Registro)
- CRUD de Lotes
- Importación de Vendedores desde API externa
- Asignación obligatoria de Vendedores a un Lote
- Listado de Vendedores por Lote

## API Endpoints

### Lotes
- GET /api/lotes
- POST /api/lotes
- PUT /api/lotes/{id}
- DELETE /api/lotes/{id}

### Vendedores
- POST /api/vendedores/import
- GET /api/lotes/{id}/vendedores

## Testing

Se incluyeron pruebas básicas con PHPUnit para validar reglas de negocio críticas.

php artisan test