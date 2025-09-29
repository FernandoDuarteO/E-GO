# E-GO

## Descripción del proyecto

E-GO es una aplicación web desarrollada y pensada para emprendedores nicaragüenses. Que les permite tener una tienda digital en la que pueden subir, editar y eliminar sus productos, así como mejorar la calidad de sus archivos multimedia mediante plantillas de edición predefinidas.

Además, ofrece la posibilidad de establecer alianzas con agencias de delivery y así gestionar los envíos de tus productos de manera eficiente.

Y los clientes podrán explorar la tienda, comprar productos de forma sencilla, calificarlos, dejar reseñas y comunicarse directamente con el emprendedor a través de un chat.

---

## Características principales

- Creación y configuración sencilla de tiendas digitales.
- CRUD productos permite crear, visualizar, editar y eliminar productos, además de gestionar imágenes y descripciones de manera intuitiva.
- Plantillas de edición para mejorar la presentación de imágenes y archivos multimedia de los productos.
- Alianzas con servicios de delivery para la gestión eficiente de envíos.
- Sistema de valoraciones y reseñas para productos.
- Chat para la comunicación entre Emprendedores y Cientes.
- Inicio de sesión con Facebook y autenticación segura.
- Panel de usuario para administrar información personal.
- Planificacion de costo.

---

## Tecnologías utilizadas

- **Backend:** Laravel (PHP >= 8.2)
- **Frontend:** Blade, JavaScript, CSS, HTML
- **Base de datos:** MySQL
- **Herramientas de desarrollo:** Composer, Node.js, NPM
- **Otras integraciones:** Facebook API

---

## Requisitos previos

Antes de comenzar a utilizar E-GO, asegúrate de tener instalado:

```
PHP >= 8.2
Composer
Node.js y NPM
MySQL
Navegador web moderno
```

---

## Instalación

Clona este repositorio en tu máquina local:

```bash
git clone https://github.com/FernandoDuarteO/E-GO.git
```

Navega a la carpeta del proyecto:

```bash
cd E-GO
```

Instala las dependencias PHP usando Composer:

```bash
composer install
```

Instala las dependencias de Node:

```bash
npm install
npm run dev
```

Copia el archivo de configuración de ejemplo y configura tu entorno:

```bash
cp .env.example .env
php artisan key:generate
```

Configura tus credenciales de base de datos y servicios externos en el archivo `.env`.

Ejecuta las migraciones de la base de datos (y los seeders si es necesario):

```bash
php artisan migrate
```

---

### Configuración de credenciales externas

#### Facebook Login

Para usar el inicio de sesión con Facebook debes crear una aplicación en [Meta for Developers](https://developers.facebook.com/):

1. Ir a **Mis aplicaciones** → **Crear aplicación**.
2. Obtener las credenciales **Client ID** y **Client Secret**.
3. Configurar la **Redirect**.
4. Agregar esas credenciales en el archivo `.env`:

```env
FACEBOOK_CLIENT_ID=tu-client-id
FACEBOOK_CLIENT_SECRET=tu-client-secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/callback
```

---

## Uso

1. Inicia el servidor:

```bash
php artisan serve
```

2. Accede a [http://localhost:8000](http://localhost:8000) desde tu navegador.

3. Explora las funcionalidades:

   - Registrarse e iniciar sesión
   - Edita tu perfil
   - Crea tu tienda digital
   - Crea, edita, actualiza y elimina productos en tu tienda digital.

---
