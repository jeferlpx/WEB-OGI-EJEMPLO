# Guía Técnica de Despliegue y Operación para OTIC
## Universidad Nacional Agraria La Molina (UNALM)
### Portal Web e Intranet de la Oficina de Gestión Interinstitucional y Asuntos Globales (OGI)

---

### 1. Resumen Ejecutivo de Infraestructura

El nuevo sistema de la OGI ha sido diseñado bajo una arquitectura web basada en **PHP 8.3+ y el framework Laravel 13**, acoplado a un motor de base de datos relacional **MySQL 8.0** hospedado en el servidor institucional `172.16.0.189` (base de datos `ogi_web`).

La aplicación está preparada para operar de forma nativa en la infraestructura institucional de la UNALM, soportando tanto **Internet Information Services (IIS 10.0+) sobre Windows Server** como **Apache 2.4+ sobre Linux/UNIX**, ya sea en la raíz de un dominio o en un subdirectorio institucional (como el actual entorno de pruebas `https://www.lamolina.edu.pe/pruebas1/david/OGI/public` o la futura ruta en producción `https://www.lamolina.edu.pe/rectorado/OGI/public`).

---

### 2. Requerimientos del Servidor Web y Módulos PHP

#### 2.1 Servidor Web
- **Microsoft IIS 10.0+:**
  - Debe tener instalado el módulo **URL Rewrite Module 2.1** de Microsoft.
  - El handler FastCGI de PHP debe estar mapeado a `*.php`.
  - Debe admitirse la lectura y ejecución de directivas en archivos `web.config` por directorio.
- **Apache 2.4+ (Alternativa):**
  - Módulos requeridos: `mod_rewrite`, `mod_headers`, `mod_deflate`, `mod_ssl`.
  - Directiva `AllowOverride All` habilitada en el bloque `<Directory>` correspondiente.

#### 2.2 Requerimientos del Intérprete PHP
- **Versión:** PHP 8.3.0 o superior (64-bit recomendado).
- **Extensiones Obligatorias:**
  - `pdo_mysql`: Para comunicación transaccional con la base de datos `172.16.0.189`.
  - `mbstring`: Procesamiento de cadenas UTF-8 multibyte para nombres y títulos.
  - `openssl`: Cifrado AES-256 de sesiones y generación de hashes seguros.
  - `fileinfo`: Detección en servidor del MIME-type real de archivos subidos (evita subidas de ejecutables enmascarados como PDFs).
  - `gd` o `imagick`: Procesamiento y optimización de imágenes y logotipos.
  - `curl`: Consumo seguro de endpoints institucionales y webhooks.
  - `xml` y `dom`: Generación del mapa del sitio XML y manipulación de documentos.
- **Directivas recomendadas en `php.ini`:**
  ```ini
  memory_limit = 256M
  upload_max_filesize = 25M
  post_max_size = 30M
  max_execution_time = 60
  date.timezone = "America/Lima"
  session.cookie_httponly = 1
  session.cookie_secure = 1
  session.use_strict_mode = 1
  ```

---

### 3. Configuración de Base de Datos Institucional (MySQL)

- **Host del Servidor:** `172.16.0.189`
- **Puerto:** `3306` (TCP)
- **Base de Datos:** `ogi_web`
- **Juego de Caracteres (Collation):** `utf8mb4_unicode_ci` (Soporte completo para caracteres en español y emojis en banderas de países).
- **Usuario Asignado:** `user_ogi`
- **Privilegios Requeridos:**
  - `SELECT`, `INSERT`, `UPDATE`, `DELETE`: Operaciones CRUD cotidianas.
  - `CREATE`, `ALTER`, `INDEX`, `DROP`: Requeridos durante el proceso inicial de migraciones (`php artisan migrate`). Posteriormente pueden restringirse en producción si la política de OTIC lo exige.

---

### 4. Estructura de Publicación y Mapeo de Subdirectorios

#### 4.1 Principio de Directorio Público Único
En Laravel, el punto de entrada es el archivo `public/index.php`. El código fuente del aplicativo (`app/`, `bootstrap/`, `config/`, `database/`, `vendor/`, `storage/` y el archivo `.env`) **NUNCA DEBE SER ACCESIBLE VÍA HTTP**.

Para garantizar esto en entornos donde el VirtualHost apunta a la carpeta contenedora `Z:\pruebas1\David\OGI\`:
1. **Archivo `index.php` en la raíz de OGI:** Redirecciona transparentemente cualquier petición no calificada hacia `/public/`.
2. **Archivo `web.config` en la raíz:** Implementa directivas `<hiddenSegments>` que devuelven código `404 Not Found` o `403 Forbidden` a cualquier intento de leer directamente `.env`, `.git`, `storage/`, `vendor/`, etc.
3. **Archivo `public/web.config`:** Contiene la regla de reescritura que redirige todas las solicitudes no coincidentes con archivos estáticos hacia `index.php`.

#### 4.2 Ajuste Especial para Unidades de Red Windows (SMB Shares / Map Drives)
En sistemas Windows que ejecutan PHP sobre recursos compartidos de red (como `Z:\`), la función nativa `is_writable()` sobre carpetas puede retornar erróneamente `false` debido a cómo Windows SMB reporta los atributos de permisos de directorio, a pesar de que el usuario del pool IIS tenga permisos completos de lectura y escritura.

El proyecto cuenta con las protecciones necesarias en `bootstrap/cache` para asegurar que el registro de paquetes y proveedores funcione fluidamente bajo esta condición.

---

### 5. Variables de Entorno de Producción (`.env`)

El archivo `.env` en el servidor debe crearse a partir de `.env.example` y resguardarse con permisos de lectura exclusivos para el usuario del servicio IIS (`IIS_IUSRS` o `IUSR`):

```env
APP_NAME="Portal OGI - UNALM"
APP_ENV=production
APP_KEY=base64:72D3LomwIe3B05O5qT+p6J72l89mH0VpI50D+96l388=
APP_DEBUG=false
APP_URL=https://www.lamolina.edu.pe/pruebas1/david/OGI/public
ASSET_URL=https://www.lamolina.edu.pe/pruebas1/david/OGI/public

DB_CONNECTION=mysql
DB_HOST=172.16.0.189
DB_PORT=3306
DB_DATABASE=ogi_web
DB_USERNAME=user_ogi
DB_PASSWORD=ogi2026$

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=true

FILESYSTEM_DISK=local
LOG_CHANNEL=stack
LOG_LEVEL=warning
```

---

### 6. Estrategia de Migración de URLs Heredadas (De ORI a OGI)

Para evitar la pérdida de posicionamiento SEO y garantizar que los enlaces publicados en resoluciones de Consejo Universitario, Secretaría General y portales externos sigan funcionando, se establecen las siguientes reglas de redirección permanente (HTTP 301):

| URL Heredada (Sitio Antiguo) | URL Nueva en OGI | Estado HTTP | Justificación |
|---|---|---|---|
| `/rectorado/ORI/index.htm` | `/public/` | `301 Permanent` | Página principal de la oficina |
| `/rectorado/ORI/presentacion.htm` | `/public/la-ogi/presentacion` | `301 Permanent` | Reseña institucional oficial |
| `/rectorado/ORI/mision.htm` | `/public/la-ogi/mision-vision` | `301 Permanent` | Misión y visión institucional |
| `/rectorado/ORI/convenios_internacionales.htm` | `/public/convenios/internacionales` | `301 Permanent` | Catálogo de convenios internacionales |
| `/rectorado/ORI/convenios_nacionales.htm` | `/public/convenios/nacionales` | `301 Permanent` | Catálogo de convenios nacionales |
| `/rectorado/ORI/movilidad.htm` | `/public/movilidad/saliente` | `301 Permanent` | Movilidad de estudiantes molineros |
| `/rectorado/ORI/estudiantes_extranjeros.htm` | `/public/movilidad/entrante` | `301 Permanent` | Movilidad de estudiantes visitantes |
| `/rectorado/ORI/becas.htm` | `/public/becas-y-convocatorias` | `301 Permanent` | Tablero de oportunidades académicas |
| `/rectorado/ORI/contactenos.htm` | `/public/contacto` | `301 Permanent` | Canales oficiales de comunicación |

> 📌 **Preservación de PDFs:** Todos los 74 archivos PDF de convenios y resoluciones históricas se han conservado en `public/documentos/` con sus nombres originales, garantizando que ninguna referencia bibliográfica previa sufra error `404 Not Found`.

---

### 7. Protocolo de Reversión (Rollback Plan)

En caso de contingencia mayor durante la puesta en producción:

1. **Reversión Rápida de Base de Datos:**
   Restaurar el dump previo generado antes de la ejecución de migraciones (Ver `docs/backup-y-restauracion.md`).
2. **Reversión del Servidor Web:**
   En IIS Manager, cambiar la ruta física del VirtualDirectory de vuelta al respaldo anterior o restaurar el enlace simbólico correspondiente.
3. **Reversión de DNS / Reescritura:**
   Desactivar temporalmente la regla de redirección 301 en el archivo `web.config` del sitio principal.

---
**Oficina de Tecnologías de la Información y Comunicaciones (OTIC)**  
Universidad Nacional Agraria La Molina — 2026
