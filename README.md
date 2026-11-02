# Portal Web Institucional y Sistema de Gestión de Contenidos (CMS / Intranet)
## Oficina de Gestión Interinstitucional y Asuntos Globales (OGI)
### Universidad Nacional Agraria La Molina — UNALM (Lima, Perú)

[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com/)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v4-06B6D4?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com/)
[![Vite](https://img.shields.io/badge/Vite-8.x-646CFF?style=flat&logo=vite&logoColor=white)](https://vitejs.dev/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Windows IIS](https://img.shields.io/badge/IIS-10.0%2B-0078D7?style=flat&logo=windows&logoColor=white)](https://www.iis.net/)
[![WCAG](https://img.shields.io/badge/Accessibility-WCAG%202.2%20AA-008080?style=flat)](https://www.w3.org/WAI/standards-guidelines/wcag/)
[![Security](https://img.shields.io/badge/Security-OWASP%20Top%2010-green?style=flat)](https://owasp.org/)

> **Repositorio Oficial:** [jeferlpx/WEB-OGI-EJEMPLO](https://github.com/jeferlpx/WEB-OGI-EJEMPLO)  
> Sistema de modernización integral que sustituye el portal histórico de la antigua ORI (`/rectorado/ORI/`), dotando a la UNALM de una plataforma web accesible, bilingüe (ES/EN), de alto rendimiento y con una intranet administrativa de gestión editorial con control de acceso basado en roles (RBAC) y auditoría inmutable.

---

## 📑 Tabla de Contenidos

1. [🏛️ Descripción General y Alcance del Proyecto](#-1-descripción-general-y-alcance-del-proyecto)
2. [💻 Requisitos Previos del Sistema](#-2-requisitos-previos-del-sistema)
3. [⚙️ Estructura del Código y Directorios](#️-3-estructura-del-código-y-directorios)
4. [🚀 Guía de Instalación Paso a Paso](#-4-guía-de-instalación-paso-a-paso)
   - [Paso 1: Clonar el Repositorio](#paso-1-clonar-el-repositorio)
   - [Paso 2: Instalar Dependencias de Backend (Composer)](#paso-2-instalar-dependencias-de-backend-composer)
   - [Paso 3: Instalar Dependencias de Frontend (NPM)](#paso-3-instalar-dependencias-de-frontend-npm)
   - [Paso 4: Configurar Variables de Entorno (`.env`)](#paso-4-configurar-variables-de-entorno-env)
   - [Paso 5: Generar la Llave de Aplicación (`APP_KEY`)](#paso-5-generar-la-llave-de-aplicación-app_key)
   - [Paso 6: Ejecutar Migraciones y Poblado de Datos (`seeders`)](#paso-6-ejecutar-migraciones-y-poblado-de-datos-seeders)
   - [Paso 7: Compilar los Recursos Frontend (Tailwind + Vite)](#paso-7-compilar-los-recursos-frontend-tailwind--vite)
   - [Paso 8: Enlace Simbólico y Permisos de Almacenamiento](#paso-8-enlace-simbólico-y-permisos-de-almacenamiento)
   - [Paso 9: Despliegue en Servidor Web (Local / IIS / Apache)](#paso-9-despliegue-en-servidor-web-local--iis--apache)
5. [👥 Credenciales Oficiales de Acceso a la Intranet](#-5-credenciales-oficiales-de-acceso-a-la-intranet)
6. [🗄️ Credenciales y Parámetros de Base de Datos](#️-6-credenciales-y-parámetros-de-base-de-datos)
7. [🌟 Módulos y Funcionalidades Destacadas](#-7-módulos-y-funcionalidades-destacadas)
   - [7.1 Administrador Multimedia de Portada (Hero) y Carrusel Interactivo](#71-administrador-multimedia-de-portada-hero-y-carrusel-interactivo)
   - [7.2 Gestor de Páginas Dinámicas en el Menú Superior (`CustomPage`)](#72-gestor-de-páginas-dinámicas-en-el-menú-superior-custompage)
   - [7.3 Motor Bilingüe Inteligente (ES / EN) y Auto-Traducción con IA](#73-motor-bilingüe-inteligente-es--en-y-auto-traducción-con-ia)
   - [7.4 Eliminación / Desvinculación de Archivos e Imágenes](#74-eliminación--desvinculación-de-archivos-e-imágenes)
   - [7.5 Placeholders Oficiales de Referencia Institucional UNALM](#75-placeholders-oficiales-de-referencia-institucional-unalm)
   - [7.6 Catálogo de Convenios con Búsqueda en Vivo y Descarga de PDFs](#76-catálogo-de-convenios-con-búsqueda-en-vivo-y-descarga-de-pdfs)
   - [7.7 Tablero de Convocatorias y Becas de Movilidad](#77-tablero-de-convocatorias-y-becas-de-movilidad)
   - [7.8 Sala de Prensa y Noticias Institucionales](#78-sala-de-prensa-y-noticias-institucionales)
   - [7.9 Control de Acceso RBAC y Auditoría Inmutable (`AuditLog`)](#79-control-de-acceso-rbac-y-auditoría-inmutable-auditlog)
8. [🗺️ Mapa de Rutas y Endpoints del Sistema](#️-8-mapa-de-rutas-y-endpoints-del-sistema)
9. [🛡️ Estándares de Seguridad y Buenas Prácticas OWASP](#️-9-estándares-de-seguridad-y-buenas-prácticas-owasp)
10. [🔧 Diagnóstico, Respaldos y Mantenimiento](#-10-diagnóstico-respaldos-y-mantenimiento)
11. [📞 Contacto Institucional y Soporte Técnico](#-11-contacto-institucional-y-soporte-técnico)

---

## 🏛️ 1. Descripción General y Alcance del Proyecto

La **Oficina de Gestión Interinstitucional y Asuntos Globales (OGI)** es el órgano rector de la **Universidad Nacional Agraria La Molina** encargado de guiar, promover, celebrar y evaluar las relaciones de cooperación académica, científica, cultural y técnica con universidades, centros de investigación, redes globales y organismos cooperantes del Perú y el extranjero.

### Objetivos Clave de la Plataforma:
1. **Sustitución Tecnológica Integral:** Migrar de páginas HTML estáticas heredadas a una arquitectura moderna MVC orientada a objetos en **Laravel 13** con **PHP 8.3**.
2. **Experiencia de Usuario Inclusiva y Bilingüe:** Selector fluido Español / Inglés con persistencia en sesión, modo oscuro/claro con tokens CSS Molineros y cumplimiento de accesibilidad **WCAG 2.2 AA**.
3. **Autonomía Administrativa Total (Sin tocar código):** Los funcionarios de la OGI pueden actualizar el héroe multimedia, crear páginas institucionales para redes u organizaciones estudiantiles (IAAS, IFSA, etc.), redactar noticias, publicar convenios y subir resoluciones PDF desde un entorno gráfico amigable.
4. **Trazabilidad y Seguridad Institucional:** Registro estricto de eventos en base de datos inmutable, control contra fuerza bruta y separación de privilegios por roles (Superadministrador, Director OGI, Editor, Revisor, Publicador, Auditor).

---

## 💻 2. Requisitos Previos del Sistema

Antes de iniciar la instalación, asegúrese de que el entorno cuente con:

| Componente | Versión Mínima Requerida | Estado de Prueba Institucional |
|---|---|---|
| **PHP** | `8.3.0` o superior | Probado en PHP 8.3.35 (x64) |
| **Servidor Web** | Microsoft IIS 10.0+ / Apache 2.4+ / Nginx 1.24+ | Operativo en IIS 10 con URL Rewrite 2.1 |
| **Base de Datos** | MySQL 8.0+ o MariaDB 10.6+ | Base `ogi_web` en servidor `172.16.0.189` |
| **Node.js** | `v20.x` o superior con `npm` | Node v20.x + Vite 8.x |
| **Composer** | `2.7.x` o superior | Composer v2.8.x |

### Extensiones PHP Obligatorias
Verifique que las siguientes extensiones estén habilitadas en su `php.ini`:
```ini
extension=pdo_mysql
extension=mbstring
extension=openssl
extension=fileinfo
extension=curl
extension=gd
extension=xml
extension=zip
extension=ctype
extension=tokenizer
extension=json
```

---

## ⚙️ 3. Estructura del Código y Directorios

```text
OGI/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/               # Controladores Intranet (Convenios, Becas, Ajustes, etc.)
│   │   │   │   ├── AgreementController.php
│   │   │   │   ├── CallController.php
│   │   │   │   ├── CustomPageController.php
│   │   │   │   ├── NewsController.php
│   │   │   │   ├── PartnerController.php
│   │   │   │   ├── SettingController.php
│   │   │   │   ├── TeamController.php
│   │   │   │   └── UserController.php
│   │   │   ├── AdminController.php  # Dashboard y analíticas de la Intranet
│   │   │   ├── AuthController.php   # Login institucional con rate limit
│   │   │   └── PublicController.php # Rutas públicas (home, convenios, movilidad, etc.)
│   │   └── Middleware/
│   │       ├── CheckRole.php         # Validación de permisos RBAC
│   │       └── SetLocale.php         # Gestión idiomática ES / EN
│   └── Models/                       # Modelos Eloquent con scopes y auto-traducción
├── bootstrap/                        # Arranque del framework
├── config/                           # Configuraciones del aplicativo
├── database/
│   ├── migrations/                   # Esquema de base de datos relacional
│   └── seeders/                      # Datos reales pre-cargados y credenciales
├── docs/                             # Documentación de ingeniería y manuales
│   ├── arquitectura.md               # Diagramas de flujo y modelos relacionales
│   ├── auditoria-sitio-actual.md     # Diagnóstico de la migración ORI
│   ├── backup-y-restauracion.md      # Procedimientos de contingencia
│   ├── despliegue-otic.md            # Manual de infraestructura para servidores
│   ├── inventario-sitio-heredado.md  # Inventario de archivos originales
│   └── manual-administrador.md       # Guía de usuario paso a paso para la OGI
├── public/                           # Directorio público expuesto al servidor web
│   ├── build/                        # Assets CSS/JS compilados por Vite
│   ├── documentos/                   # 74 resoluciones y convenios en PDF oficiales
│   ├── imagenes/                     # Banners, logotipos oficiales y placeholders SVG
│   ├── videos/                       # Video institucional de fondo (.mp4)
│   ├── index.php                     # Front controller
│   ├── robots.txt                    # Directivas para motores de búsqueda
│   ├── sitemap.xml                   # Mapa del sitio canónico
│   └── web.config                    # Reglas de URL Rewrite para Windows IIS
├── resources/
│   ├── css/app.css                   # Diseño Molinero con Tailwind CSS v4
│   ├── js/app.js                     # Buscador interactivo, dark mode, traductor
│   └── views/                        # Vistas Blade (portal público y admin)
├── routes/
│   └── web.php                       # Rutas estructuradas y securizadas
├── storage/                          # Logs, sesiones y archivos de aplicación
├── .env.example                      # Plantilla de variables de entorno segura
├── .gitignore                        # Reglas de exclusión de repositorio
├── composer.json                     # Paquetes y librerías de PHP
├── package.json                      # Herramientas de empaquetado frontend
├── vite.config.js                    # Configuración de compilación Vite
└── web.config                        # Reglas de aislamiento de seguridad raíz en IIS
```

---

## 🚀 4. Guía de Instalación Paso a Paso

Siga estos pasos en orden para desplegar el proyecto localmente o en un servidor de prueba o producción.

### Paso 1: Clonar el Repositorio
Abra una terminal (PowerShell, Git Bash o CMD) en la ruta destino:

```bash
git clone https://github.com/jeferlpx/WEB-OGI-EJEMPLO.git OGI
cd OGI
```

### Paso 2: Instalar Dependencias de Backend (Composer)
Instale las librerías de PHP especificadas en `composer.json`:

```bash
composer install --no-interaction --prefer-dist --optimize-autoloader
```

### Paso 3: Instalar Dependencias de Frontend (NPM)
Instale las dependencias de JavaScript y Tailwind CSS:

```bash
npm install
```

### Paso 4: Configurar Variables de Entorno (`.env`)
Genere su archivo local `.env` a partir de la plantilla segura `.env.example`:

**En Windows (PowerShell / CMD):**
```powershell
copy .env.example .env
```

**En Linux / macOS:**
```bash
cp .env.example .env
```

Edite `.env` con un editor de texto (Notepad, VS Code, Nano) y ajuste los valores según su entorno:

```env
APP_NAME="Portal OGI - UNALM"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://www.lamolina.edu.pe/pruebas1/david/OGI/public

# Conexión a Base de Datos MySQL
DB_CONNECTION=mysql
DB_HOST=172.16.0.189
DB_PORT=3306
DB_DATABASE=ogi_web
DB_USERNAME=user_ogi
DB_PASSWORD=ogi2026$

# Sesiones Seguras
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
```

> 💡 **Nota para desarrollo local:** Si corre el sistema en su equipo propio con XAMPP / Laragon / Docker, configure:
> ```env
> APP_ENV=local
> APP_DEBUG=true
> APP_URL=http://localhost:8000
> DB_HOST=127.0.0.1
> DB_DATABASE=ogi_web
> DB_USERNAME=root
> DB_PASSWORD=
> ```

### Paso 5: Generar la Llave de Aplicación (`APP_KEY`)
Ejecute el generador criptográfico de Laravel:

```bash
php artisan key:generate
```

### Paso 6: Ejecutar Migraciones y Poblado de Datos (`seeders`)
Cree las tablas relacionales y cargue los datos iniciales (74 convenios reales de la UNALM, convocatorias, noticias, equipo de gestión, aliados, ajustes de portada y las 6 cuentas con roles):

```bash
php artisan migrate --force
php artisan db:seed --force
```

### Paso 7: Compilar los Recursos Frontend (Tailwind + Vite)
Genere los activos minificados optimizados en `public/build/`:

```bash
npm run build
```

### Paso 8: Enlace Simbólico y Permisos de Almacenamiento
Cree el enlace para el almacenamiento de archivos públicos:

```bash
php artisan storage:link
```

Asegúrese de que el usuario del servidor web (`IIS_IUSRS` en Windows o `www-data` en Linux) cuente con permisos de **Lectura y Escritura** sobre:
- `storage/`
- `bootstrap/cache/`
- `public/documentos/`
- `public/imagenes/`

### Paso 9: Despliegue en Servidor Web (Local / IIS / Apache)

#### Opción A: Servidor de Desarrollo Local Rápido
```bash
php artisan serve
```
El portal estará disponible de inmediato en: `http://127.0.0.1:8000`

#### Opción B: Despliegue en Windows Server / IIS 10
1. Asegúrese de que el módulo **URL Rewrite 2.1** de Microsoft esté instalado en IIS.
2. Cree un Sitio Web o Aplicación apuntando a la carpeta física `OGI/public` (o bien a la raíz de `OGI` aprovechando los archivos `web.config` preconfigurados incluidos).
3. Verifique que el grupo `IIS_IUSRS` y la cuenta `IUSR` tengan permisos de lectura/escritura en `storage` y `bootstrap/cache`.
4. El archivo `public/web.config` ya incluye todas las reglas de reescritura para enrutar las peticiones a `index.php`.

#### Opción C: Despliegue en Linux con Apache 2.4+
Habilite el módulo de reescritura y cree su VirtualHost:
```bash
sudo a2enmod rewrite
```
En la configuración del VirtualHost:
```apache
<VirtualHost *:80>
    ServerName ogi.lamolina.edu.pe
    DocumentRoot /var/www/OGI/public

    <Directory /var/www/OGI/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/ogi_error.log
    CustomLog ${APACHE_LOG_DIR}/ogi_access.log combined
</VirtualHost>
```

---

## 👥 5. Credenciales Oficiales de Acceso a la Intranet

Para ingresar al panel administrativo, diríjase a:  
**URL:** `https://www.lamolina.edu.pe/pruebas1/david/OGI/public/intranet/login`  
*(o `http://localhost:8000/intranet/login` en desarrollo local)*

| Rol Institucional | Correo Electrónico | Contraseña Inicial | Alcance de Permisos |
|---|---|---|---|
| **Superadministrador** | `admin@lamolina.edu.pe` | `OGI2026!Admin` | Control total del sistema, gestión de usuarios, asignación de roles, configuración general y auditoría inmutable. |
| **Director OGI** | `director.ogi@lamolina.edu.pe` | `OGI2026!Director` | Aprobación editorial, supervisión de convenios, noticias, métricas y ajustes del mensaje de dirección. |
| **Editor OGI** | `editor.ogi@lamolina.edu.pe` | `OGI2026!Editor` | Creación y modificación de borradores de convenios, convocatorias de movilidad, noticias y páginas institucionales. |
| **Revisor Institucional**| `revisor.ogi@lamolina.edu.pe` | `OGI2026!Revisor` | Revisión técnica de contenidos en estado "En Revisión" y emisión de observaciones previas a publicación. |
| **Publicador Oficial** | `publicador.ogi@lamolina.edu.pe`| `OGI2026!Publicador` | Autorización final para cambiar el estado a "Publicado" y hacer visible el contenido en el portal público. |
| **Auditoría / OTIC** | `consulta.ogi@lamolina.edu.pe` | `OGI2026!Auditor` | Modo de sólo lectura para fiscalización técnica, trazabilidad forense y consulta de logs inmutables. |

> 🔒 **Recomendación de Seguridad:** Se sugiere cambiar las contraseñas iniciales una vez transferido el sistema a los operadores oficiales.

---

## 🗄️ 6. Credenciales y Parámetros de Base de Datos

El sistema viene configurado para comunicarse con el servidor MySQL institucional:

```ini
[MySQL Institucional UNALM]
Servidor (Host)      : 172.16.0.189
Puerto               : 3306 (TCP)
Base de Datos        : ogi_web
Juego de Caracteres  : utf8mb4 / utf8mb4_unicode_ci
Usuario              : user_ogi
Contraseña           : ogi2026$
```

---

## 🌟 7. Módulos y Funcionalidades Destacadas

### 7.1 Administrador Multimedia de Portada (Hero) y Carrusel Interactivo
Desde **Ajustes y Contenidos** (`/intranet/ajustes`), el administrador puede elegir entre 5 modos visuales:
- **Foto Fija:** Fondo institucional estático con velo de contraste graduable.
- **Carrusel Animado:** Rotación automática de diapositivas oficiales cada 5.5 segundos.
- **Video Local (.mp4):** Reproducción fluida y silenciosa de video de fondo optimizado.
- **Video de YouTube:** Inserción directa de enlaces de video de YouTube sin tocar código.
- **Degradado Clásico:** Fondo institucional en Verde Molinero sin imagen.

#### Asignación y Reordenamiento del Carrusel de Fotos
- **Numeración Secuencial Visual:** Cada tarjeta del catálogo de fotos pre-cargadas exhibe su número de secuencia (**`#1`**, **`#2`**, **`#3`**...).
- **Controles Rápidos `◀` y `▶`:** Permite mover cualquier fotografía antes o después en la rotación en tiempo real. La actualización se sincroniza al instante en la base de datos vía AJAX (`POST /intranet/ajustes/reorder-banner/{id}`) sin recargar la página.
- **Subida Directa desde el PC:** Módulo asíncrono con barra de progreso en vivo para subir nuevas fotografías en JPG, PNG o WebP (hasta 15 MB) que quedan guardadas en el catálogo.
- **Inclusión / Exclusión Selectiva:** Botón toggle `[✓ En Carrusel]` para activar o desactivar cada foto de la rotación pública.

### 7.2 Gestor de Páginas Dinámicas en el Menú Superior (`CustomPage`)
Permite registrar y administrar páginas institucionales dedicadas (ej: IAAS, IFSA, redes temáticas) asociadas a cualquier sección del menú de navegación:
- **Secciones Disponibles:** *La OGI*, *Convenios*, *Aliados Estratégicos*, *Redes Nacionales*, *Redes Internacionales*, *Cooperación*.
- **Enlace Amigable (Slug):** Autogenerado o personalizable (ej: `/pagina/iaas-peru`).
- **Contenido Enriquecido:** Título, resumen, contenido en HTML formateado, fotografía destacada y banner.
- Si no se cuenta con imagen propia, el sistema inyecta automáticamente la **fotografía institucional de referencia UNALM**.

### 7.3 Motor Bilingüe Inteligente (ES / EN) y Auto-Traducción con IA
- **Portal Público:** Selector instantáneo Español / Inglés en la cabecera superior con persistencia en sesión.
- **Auto-Traductor Integrado con IA en la Intranet:** Todos los formularios de edición cuentan con el botón **✨ Auto-traducir a Inglés**, el cual traduce de forma inteligente títulos, resúmenes, biografías, cargos y descripciones respetando la terminología académica universitaria.

### 7.4 Eliminación / Desvinculación de Archivos e Imágenes
Todos los módulos de la Intranet permiten **eliminar o desvincular imágenes y archivos PDF** mediante una casilla de verificación explícita (`[ 🗑️ Quitar fotografía / archivo actual ]`), superando la limitación de únicamente poder "reemplazar".

### 7.5 Placeholders Oficiales de Referencia Institucional UNALM
Si un registro (Director, Página, Noticia, Miembro del Equipo, Aliado) no cuenta con fotografía o logotipo:
- **Español:** [`public/imagenes/placeholder_referencia.svg`](file:///z:/pruebas1/David/OGI/public/imagenes/placeholder_referencia.svg) — *«Fotografía Pendiente de Carga — Espacio reservado para imagen institucional de la UNALM»*.
- **Inglés:** [`public/imagenes/placeholder_referencia_en.svg`](file:///z:/pruebas1/David/OGI/public/imagenes/placeholder_referencia_en.svg) — *«Official Photo Pending Upload — Reserved space for UNALM institutional imagery»*.
Diseñados en SVG vectorial ultraligero con la paleta de colores Verde Molinero (`#0F5132`) y Dorado Molinero (`#D4AF37`), garantizando nitidez perfecta en pantallas Retina y móviles.

### 7.6 Catálogo de Convenios con Búsqueda en Vivo y Descarga de PDFs
- Base de datos con **74 convenios y resoluciones oficiales reales** en formato PDF organizados por país y universidad.
- Buscador reactivo en vivo con filtros por país, tipo de convenio (Marco, Específico, Cooperación), vigencia (Vigente, Por Vencer, Vencido) y alcance de facultades.

### 7.7 Tablero de Convocatorias y Becas de Movilidad
- Información categorizada para Movilidad Saliente ("Molinero en el Mundo") y Movilidad Entrante ("Estudia en La Molina").
- Indicador visual de estado de convocatoria (Abierta, Próxima, Cerrada), bases oficiales en PDF descargables y enlaces a formularios de postulación.

### 7.8 Sala de Prensa y Noticias Institucionales
- Publicación de artículos, visitas de delegaciones extranjeras, eventos y ceremonias con fecha, autor, categoría y soporte bilingüe.

### 7.9 Control de Acceso RBAC y Auditoría Inmutable (`AuditLog`)
- Enforzamiento estricto de roles en el middleware `CheckRole.php`.
- Registro inmutable de cada creación, actualización o eliminación en la tabla `audit_logs`, registrando usuario, rol, dirección IP, entidad afectada y estampa de tiempo.

---

## 🗺️ 8. Mapa de Rutas y Endpoints del Sistema

### 8.1 Portal Público
| Método | Ruta | Controlador y Acción | Descripción |
|---|---|---|---|
| `GET` | `/` | `PublicController@home` | Portada institucional con héroe multimedia, buscador y destacados |
| `GET` | `/la-ogi` | `PublicController@presentation` | Presentación institucional y mensaje de dirección |
| `GET` | `/la-ogi/mision-vision` | `PublicController@missionVision` | Marco estratégico institucional |
| `GET` | `/la-ogi/equipo` | `PublicController@team` | Directorio de profesionales de la OGI |
| `GET` | `/convenios` | `PublicController@agreements` | Catálogo interactivo de convenios nacionales e internacionales |
| `GET` | `/convenios/nacionales` | `PublicController@agreementsNational` | Convenios con universidades e instituciones peruanas |
| `GET` | `/convenios/internacionales`| `PublicController@agreementsInternational`| Convenios bilaterales y multilaterales internacionales |
| `GET` | `/movilidad` | `PublicController@mobility` | Portal general de movilidad académica |
| `GET` | `/movilidad/saliente` | `PublicController@mobilityOutgoing` | Guía de postulación para estudiantes molineros |
| `GET` | `/movilidad/entrante` | `PublicController@mobilityIncoming` | Guía de postulación para estudiantes extranjeros |
| `GET` | `/becas` | `PublicController@calls` | Tablero de oportunidades, becas y pasantías |
| `GET` | `/becas/{slug}` | `PublicController@callShow` | Ficha detallada de una convocatoria con bases PDF |
| `GET` | `/noticias` | `PublicController@news` | Sala de prensa y comunicados oficiales |
| `GET` | `/noticias/{slug}` | `PublicController@newsShow` | Noticia completa con galería y fuentes |
| `GET` | `/pagina/{slug}` | `PublicController@customPage` | Vista dinámica de páginas institucionales creadas desde el CMS |
| `GET` | `/redes` | `PublicController@networks` | Redes académicas y consorcios globales |
| `GET` | `/recursos` | `PublicController@resources` | Formatos descargables, reglamentos y guías |
| `GET` | `/contacto` | `PublicController@contact` | Canales oficiales de atención presencial y virtual |
| `GET` | `/cambiar-idioma/{locale}`| `PublicController@switchLocale` | Alternador bilingüe reactivo (es/en) |

### 8.2 Intranet Administrativa (CMS)
| Método | Ruta | Controlador y Acción | Rol Mínimo |
|---|---|---|---|
| `GET` | `/intranet/login` | `AuthController@showLogin` | Público |
| `POST` | `/intranet/login` | `AuthController@login` | Público (Con Rate Limiting) |
| `POST` | `/intranet/logout` | `AuthController@logout` | Autenticado |
| `GET` | `/intranet/dashboard` | `AdminController@dashboard` | Consulta / Operador |
| `RESOURCE`| `/intranet/convenios` | `Admin\AgreementController` | Editor / Publicador |
| `RESOURCE`| `/intranet/convocatorias` | `Admin\CallController` | Editor / Publicador |
| `RESOURCE`| `/intranet/noticias` | `Admin\NewsController` | Editor / Publicador |
| `RESOURCE`| `/intranet/paginas` | `Admin\CustomPageController` | Editor / Publicador |
| `RESOURCE`| `/intranet/equipo` | `Admin\TeamController` | Editor / Publicador |
| `RESOURCE`| `/intranet/aliados` | `Admin\PartnerController` | Editor / Publicador |
| `GET` | `/intranet/ajustes` | `Admin\SettingController@index` | Director / Superadmin |
| `POST` | `/intranet/ajustes` | `Admin\SettingController@update` | Director / Superadmin |
| `POST` | `/intranet/ajustes/upload-banner` | `Admin\SettingController@uploadBanner` | Director / Superadmin |
| `POST` | `/intranet/ajustes/reorder-banner/{id}`| `Admin\SettingController@reorderBanner` | Director / Superadmin |
| `POST` | `/intranet/ajustes/delete-banner/{id}` | `Admin\SettingController@deleteBanner` | Director / Superadmin |
| `RESOURCE`| `/intranet/usuarios` | `Admin\UserController` | Superadministrador |
| `GET` | `/intranet/auditoria` | `AdminController@audit` | Superadministrador / Auditor |

---

## 🛡️ 9. Estándares de Seguridad y Buenas Prácticas OWASP

1. **Protección Anti-CSRF:** Cada formulario de la intranet incluye un token CSRF verificado por middleware de sesión.
2. **Protección contra Fuerza Bruta (Rate Limiting):** Límite estricto de 5 intentos fallidos por minuto por dirección IP en el formulario de inicio de sesión (`AuthController.php`).
3. **Control de Acceso Basado en Roles (RBAC):** Middleware `CheckRole.php` que valida los privilegios del usuario antes de invocar los controladores.
4. **Prevención de Ataques XSS:** Motor de plantillas Blade con escape automático de entidades HTML `{{ ... }}` en todas las salidas dinámicas.
5. **Aislamiento de Archivos Sensibles en IIS:** Archivo `web.config` raíz configurado con `<hiddenSegments>` que bloquea cualquier acceso HTTP a `.env`, `.git`, `storage/`, `vendor/` y archivos de configuración.
6. **Manejo Seguro de Archivos Subidos:**
   - Verificación estricta de extensiones (`pdf`, `png`, `jpg`, `webp`, `mp4`).
   - Verificación de tipos MIME reales en servidor mediante `fileinfo`.
   - Asignación de nombres de archivo aleatorizados con `uniqid()` y marcas de tiempo para evitar sobreescrituras accidentales o inyección de nombres maliciosos.
7. **Trazabilidad Inmutable:** Registro automático en la tabla `audit_logs` con usuario, IP, acción y timestamp ante cualquier cambio editorial.

---

## 🔧 10. Diagnóstico, Respaldos y Mantenimiento

### 10.1 Limpieza y Recompilación de Caché
En caso de realizar ajustes en configuración, rutas o plantillas, ejecute:

```bash
php artisan optimize:clear
php artisan view:clear
php artisan config:clear
php artisan cache:clear
```

### 10.2 Respaldo de Base de Datos
Para generar un dump completo de la base de datos MySQL institucional:

```bash
mysqldump -h 172.16.0.189 -u user_ogi -pogi2026$ ogi_web > backup_ogi_$(date +%Y%m%d_%H%M%S).sql
```

### 10.3 Restauración de Base de Datos
```bash
mysql -h 172.16.0.189 -u user_ogi -pogi2026$ ogi_web < backup_ogi_referencia.sql
```

---

## 📞 11. Contacto Institucional y Soporte Técnico

**Oficina de Gestión Interinstitucional y Asuntos Globales (OGI)**  
Universidad Nacional Agraria La Molina (UNALM)  
- **Dirección:** Av. La Molina s/n, La Molina, Lima - Perú (Pabellón de Rectorado, 2do Piso).  
- **Teléfono:** (511) 614-7800 Anexo 407  
- **Correo Institucional:** `ogi@lamolina.edu.pe`  
- **Portal Web Oficial:** `https://www.lamolina.edu.pe/rectorado/ORI/`  
- **Entorno de Pruebas:** `https://www.lamolina.edu.pe/pruebas1/david/OGI/public/`

---
*Desarrollado y optimizado con altos estándares de ingeniería de software, accesibilidad e identidad institucional Molinera — 2026.*
