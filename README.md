# Proyecto Lote-Vendedor

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![Status](https://img.shields.io/badge/Status-In%20Development-orange?style=for-the-badge)
![Version](https://img.shields.io/badge/Version-indev.0.1.0-blue?style=for-the-badge)


## 📚 Documentación

- [Arquitectura](docs/architecture.md)
- [Base de datos](docs/database.md)

## Descripción

Proyecto de prueba creado para experimentar con **Laravel 12** y **Vue 3**, enfocado en la gestión básica de lotes y vendedores.  
El proyecto funciona como un entorno de testeo para explorar la integración de frontend y backend mediante **Vite**, así como el uso de **Sass** y buenas prácticas de organización.

## D

## Requisitos

Antes de descargar este proyecto asegurese de contar con:

- PHP **8.2 o superior**
- Composer
- Node.js **LTS**
- npm
- Servidor local (XAMPP, Laragon o similar)
- Git

## Guía de Instalación Rápida

1. Clona el repositorio:
	```bash
	git clone https://github.com/tu-usuario/tu-repo.git
	cd tu-repo
	```
2. Instala dependencias de PHP y Node.js:
	```bash
	composer install
	npm install
	```
3. Copia el archivo de entorno y genera la clave:
	```bash
	cp .env.example .env
	php artisan key:generate
	```
4. Ejecuta migraciones y seeders:
	```bash
	php artisan migrate --seed
	```
5. Inicia los servidores de desarrollo:
	```bash
	npm run dev
	php artisan serve
	```

¡Listo! Accede a la aplicación en tu navegador.

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
- POST /api/vendedores/sync
- GET /api/lotes/{id}/vendedores *(requiere que la ruta esté registrada, ver código)*

## API Publica
- GET /api/quick/lotes/1/vendedores *(Regresa un json con los vendedores asignados a ese lote)*
