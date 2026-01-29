# Prueba Técnica Luis Torrealba

Prueba Técnica en Laravel/JWT/API Rest/SQLite

## Pre-Requisitos
1. php 7.4
2. Composer 2.6.6
3. npm version >10.0

## Instalación

## Clonar repositorio

```bash
git clone https://github.com/luisOSL/libreria-intelli.git
cd libreria-intelli
```

### Opción 1: User Docker Container:
```bash
docker compose up -d --build
docker exec -it libreria-mvp php artisan key:generate
docker exec -it libreria-mvp php artisan jwt:secret
docker exec -it libreria-mvp php artisan migrate
```

### Opción 2: User el repositorio si cumple con los pre-requisitos:


## Copiar .env
```php
#copiar .env
copy .env.example .env

#instalar dependencias
composer install

#crear Secret de Token JWT
php artisan jwt:secret
```

## Creación de base de datos sqlite
```bash
#Si su S.O es Windows:
type nul > database/database.sqlite

#Si su S.O es Unix (Ubuntu, debian":
touch database/database.sqlite
```

## Migración de Modelos
```php
php artisan migrate
```
## Instalar dependencias NPM
```bash
npm install && npm run dev
```

## Iniciar el servidor Local:
```php
php artisan serve

deberá ver en su pantalla algo como esto:
Laravel development server started: <http://127.0.0.1:8000>
[Wed Jan 28 14:00:19 2026] PHP 7.4.26 Development Server (http://127.0.0.1:8000) started
```

## Creación de usuario inicial:

Haga click para registrar su usuario y acceder al sistema:

- [Link de Registro](http://localhost:8000/register)
- [Link de Acceso](http://localhost:8000/login)

## Derechos
Creado por - [Luis Torrealba](mailto:luis@luistorrealba.com) exclusivamente para la prueba técnica de Intelli-Next