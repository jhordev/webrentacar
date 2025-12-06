# 🚀 Guía de Inicio - WebRentACar

Esta guía te ayudará a configurar y ejecutar el proyecto Laravel desde cero.

## 📋 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **PHP** ^8.2 o superior
- **Composer** (gestor de dependencias de PHP)
- **Node.js** y **npm** (para los assets del frontend)
- **SQLite** (o cualquier base de datos que prefieras: MySQL, PostgreSQL)
- **Git**

### Verificar versiones instaladas

```bash
php -v
composer -v
node -v
npm -v
```

---

## 🔧 Instalación del Proyecto

### 1. Clonar el repositorio

```bash
git clone <URL_DEL_REPOSITORIO> webrentacar
cd webrentacar
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

Este comando instalará todas las dependencias de Laravel definidas en `composer.json`, incluyendo:
- Laravel Framework ^12.0
- Filament ^3.3 (panel de administración)
- Laravel Tinker

### 3. Instalar dependencias de Node.js

```bash
npm install
```

Este comando instalará las dependencias de frontend, incluyendo:
- Vite
- TailwindCSS
- Vue.js (para componentes)

### 4. Configurar el archivo de entorno

Copia el archivo de ejemplo `.env.example` a `.env`:

```bash
# En Windows (PowerShell)
Copy-Item .env.example .env

# En Windows (CMD)
copy .env.example .env

# En Linux/Mac
cp .env.example .env
```

### 5. Generar la clave de aplicación

```bash
php artisan key:generate
```

Este comando generará una clave única para tu aplicación en el archivo `.env`.

### 6. Configurar la base de datos

El proyecto está configurado para usar **SQLite** por defecto. El archivo de base de datos se creará automáticamente en `database/database.sqlite`.

Si prefieres usar **MySQL** u otra base de datos, edita el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webrentacar
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### 7. Crear el archivo de base de datos SQLite

Si usas SQLite (configuración por defecto):

```bash
# En Windows (PowerShell)
New-Item -ItemType File -Path database/database.sqlite -Force

# En Windows (CMD)
type nul > database/database.sqlite

# En Linux/Mac
touch database/database.sqlite
```

### 8. Ejecutar las migraciones

```bash
php artisan migrate
```

Este comando creará todas las tablas necesarias en la base de datos.

### 9. Ejecutar los seeders (datos iniciales)

```bash
php artisan db:seed
```

Este comando poblará la base de datos con datos iniciales, incluyendo:
- Estados y Municipios
- Marcas de vehículos
- Modelos de vehículos
- Categorías
- Usuario de prueba (test@example.com)

---

## ▶️ Ejecutar el Proyecto

### Opción 1: Ejecutar manualmente (dos terminales)

**Terminal 1 - Servidor Laravel:**
```bash
php artisan serve
```
La aplicación estará disponible en: `http://localhost:8000`

**Terminal 2 - Compilar assets (Vite):**
```bash
npm run dev
```

### Opción 2: Ejecutar con script integrado (recomendado)

El proyecto incluye un script de desarrollo que ejecuta todo en paralelo:

```bash
composer dev
```

Este comando ejecutará automáticamente:
- Servidor de desarrollo PHP (`php artisan serve`)
- Cola de trabajos (`php artisan queue:listen`)
- Logs en tiempo real (`php artisan pail`)
- Compilación de assets (`npm run dev`)

---

## 🎨 Acceder al Panel de Administración Filament

El proyecto utiliza **Filament** para el panel de administración. Para acceder:

1. Primero, crea un usuario administrador:

```bash
php artisan make:filament-user
```

2. Sigue las instrucciones en la terminal para ingresar:
   - Nombre
   - Email
   - Contraseña

3. Accede al panel en: `http://localhost:8000/admin`

---

## 📁 Estructura del Proyecto Laravel

```
webrentacar/
├── app/                    # Código de la aplicación
│   ├── Http/               # Controladores, Middleware
│   ├── Models/             # Modelos Eloquent
│   ├── Filament/           # Recursos del panel de administración
│   └── Providers/          # Service Providers
├── config/                 # Archivos de configuración
├── database/
│   ├── migrations/         # Migraciones de base de datos
│   └── seeders/           # Seeders (datos iniciales)
├── public/                 # Archivos públicos (imágenes, CSS, JS compilado)
├── resources/
│   ├── views/             # Vistas Blade
│   ├── css/               # Estilos
│   └── js/                # JavaScript
├── routes/
│   ├── web.php            # Rutas web
│   ├── api.php            # Rutas API
│   └── console.php        # Comandos Artisan personalizados
├── storage/               # Archivos generados (logs, cache, uploads)
├── tests/                 # Tests automatizados
├── .env                   # Variables de entorno (NO incluir en Git)
├── artisan                # CLI de Laravel
├── composer.json          # Dependencias PHP
└── package.json           # Dependencias Node.js
```

---

## 🛠️ Comandos Útiles de Laravel

### Artisan (CLI de Laravel)

```bash
# Ver todos los comandos disponibles
php artisan list

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ver rutas registradas
php artisan route:list

# Crear un nuevo modelo con migración, factory y seeder
php artisan make:model NombreModelo -mfs

# Crear un nuevo controlador
php artisan make:controller NombreController

# Ejecutar tests
php artisan test
```

### Base de datos

```bash
# Refrescar base de datos (CUIDADO: elimina todos los datos)
php artisan migrate:fresh

# Refrescar base de datos y ejecutar seeders
php artisan migrate:fresh --seed

# Revertir última migración
php artisan migrate:rollback

# Ver estado de las migraciones
php artisan migrate:status
```

### Colas (Queues)

```bash
# Ejecutar trabajos en cola (modo escucha)
php artisan queue:listen

# Ejecutar trabajos en cola (una vez)
php artisan queue:work

# Limpiar trabajos fallidos
php artisan queue:flush
```

---

## 🔒 Configuración Adicional

### Configurar el nombre de la aplicación

Edita el archivo `.env`:

```env
APP_NAME="WebRentACar"
APP_URL=http://localhost:8000
```

### Configurar el correo electrónico

Por defecto, los correos se registran en logs. Para configurar un servidor SMTP real:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=tu_contraseña
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🐛 Solución de Problemas Comunes

### Error: "Class not found"

```bash
composer dump-autoload
```

### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [14] unable to open database file"

Asegúrate de que el archivo `database/database.sqlite` exista y tenga permisos de escritura.

### Error al compilar assets

```bash
# Limpiar caché de npm
npm cache clean --force

# Reinstalar dependencias
rm -rf node_modules package-lock.json
npm install
```

### Permisos en Linux/Mac

```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

---

## 📚 Recursos Adicionales

- [Documentación oficial de Laravel](https://laravel.com/docs)
- [Documentación de Filament](https://filamentphp.com/docs)
- [Laravel Bootcamp](https://bootcamp.laravel.com)
- [Laracasts (Video Tutoriales)](https://laracasts.com)

---

## 📝 Notas Importantes

- **NO subas el archivo `.env` a Git** - Contiene información sensible
- **El archivo `database/database.sqlite`** está ignorado en Git por seguridad
- **Ejecuta las migraciones** cada vez que actualices el código desde el repositorio
- **Mantén actualizado Composer y NPM** para evitar problemas de compatibilidad

---

## ✅ Checklist de Verificación

Después de seguir todos los pasos, verifica:

- [ ] El servidor Laravel está corriendo en `http://localhost:8000`
- [ ] Los assets se compilan sin errores con `npm run dev`
- [ ] Puedes acceder a la página principal
- [ ] Puedes acceder al panel de administración en `/admin`
- [ ] La base de datos tiene los datos iniciales (seeders ejecutados)
- [ ] No hay errores en la consola del navegador

---

¡Todo listo! Tu proyecto Laravel **WebRentACar** está configurado y funcionando. 🎉
