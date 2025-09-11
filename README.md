# E-GO

### Características principales


### Tecnologías utilizadas


### Requisitos previos


### Instalación

Clona este repositorio en tu máquina local:
```bash
git clone 
```
Navega a la carpeta del proyecto:
```bash
cd 
```
Instala las dependencias PHP usando Composer:
```bash
composer install
```
Instala las dependencias
```bash
npm install
```
Copia el archivo de configuración de ejemplo y configura tu entorno:
```bash
cp .env.example .env
php artisan key:generate
```
Ejecuta las migraciones de la base de datos y los seeders (si es necesario):
```bash
php artisan migrate:fresh
```
Inicia el servidor de desarrollo:
```bash
php artisan serve
```
