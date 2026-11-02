# Auditoría Integral del Sitio Web Heredado — ORI / OGI UNALM

**Fecha de emisión:** 27 de octubre de 2026  
**Área evaluada:** Oficina de Gestión Interinstitucional y Asuntos Globales (OGI) — Anteriormente Oficina de Relaciones Interinstitucionales (ORI)  
**Institución:** Universidad Nacional Agraria La Molina (UNALM)  
**Ruta auditada:** `Z:\Rectorado\ORI`  
**Entorno de despliegue objetivo:** `Z:\pruebas1\David\OGI` -> `https://www.lamolina.edu.pe/pruebas1/david/OGI/`  
**Base de datos asignada:** `ogi_web` (`172.16.0.189`)  

---

## 1. Diagnóstico del Sitio Heredado: Qué existe actualmente

El sitio web actual ubicado en `Z:\Rectorado\ORI` consta de una estructura estática histórica desarrollada en Dreamweaver / HTML tradicional con 276 archivos físicos:
- **36 páginas HTML/HTM:** Portada (`index.htm`), institucional (`presentacion.htm`, `vision_mision.htm`), convenios (`convenios_internacionales.htm`, `convenios_nacionales.htm`), movilidad (`estudia_extranjero.htm`, `estudia_unalm.htm`, `excelencia_academica.htm`, etc.), redes (`redes_internacionales.htm`, `redes_nacionales.htm`, `REDI_PERU.htm`, `RUNAI.htm`, `IAAS.htm`, `IFSA.htm`), programas de becas (`beca_alianza_pacifico.htm`, `beca_santander.htm`, `pronabec.htm`, `jica.htm`, etc.) y notas de prensa (`noticias.htm`, `nota1.htm` ... `nota5.htm`).
- **112 documentos descargables:** 106 PDFs, 5 DOCX y 1 archivo XLS (`BASE_GENERAL_DE_CONVENIOS.xls`).
  - 67 convenios internacionales en PDF organizados en 19 carpetas por país (Alemania, Argentina, Austria, Brasil, Chile, Colombia, Ecuador, España, Francia, Finlandia, Honduras, Italia, India, Japón, México, Portugal, Rusia, Turquía, USA).
  - 10 convenios nacionales en PDF (Callao, Quillabamba, UNAMAD, UPC, UTEC, ESAN, Andina del Cusco, Huancavelica, Frontera, UTN).
  - Listas consolidadas en PDF actualizadas al 17 de octubre de 2025 (`Convenios_Internacionales.pdf`, `Convenios_Nacionales.pdf`).
  - 4 boletines molineros en PDF (ediciones 2016 a 2019).
  - Guías del estudiante de intercambio (entrante y saliente).
  - Listas y resoluciones del Programa de Becas por Excelencia Académica Internacional (BEAI 2020 a 2025).
  - CVs y hojas de vida del equipo directivo y técnico de la OGI.
- **110 recursos gráficos:** Logotipos oficiales de la UNALM y de la OGI, logotipos de aliados estratégicos (APCI, Comisión Fulbright, Embajada USA, JICA, KOICA, PRONABEC), fotografías del campus y eventos protocolares.
- **18 archivos técnicos obsoletos:** Archivos de metadatos locales de Windows (`Thumbs.db`), carpetas de Dreamweaver (`_notes/`), y librerías CSS/JS antiguas de Bootstrap 4/5 sin optimización ni compilador.

---

## 2. Principales Fricciones UX/UI y Problemas Técnicos Detectados

### 2.1 Problemas de Experiencia de Usuario (UX)
1. **Falta de buscador y filtros para Convenios:** Las páginas `convenios_internacionales.htm` y `convenios_nacionales.htm` solo contenían un botón grande que abría un PDF estático. Los estudiantes y docentes no podían buscar por país, área académica, tipo de convenio ni vigencia en la web.
2. **Arquitectura plana y enlaces repetidos:** Todos los 36 archivos HTML repetían exactamente el mismo menú estático de cabecera con código duplicado. Cualquier cambio en un enlace requería modificar 36 archivos a mano.
3. **Invisibilidad de oportunidades y convocatorias:** No existía diferenciación entre convocatorias abiertas, próximas a cerrar y convocatorias históricas cerradas.
4. **Barrera para estudiantes internacionales:** La página de movilidad entrante carecía de versión en inglés, formulario guiado o visualización paso a paso de requisitos y calendario.
5. **Poca jerarquía visual y contraste insuficiente:** Texto sin espaciado tipográfico moderno, contrastes débiles en enlaces y ausencia total de modo oscuro para accesibilidad visual nocturna.

### 2.2 Problemas Técnicos y de Mantenibilidad
1. **Ausencia de CMS / Intranet:** Cualquier actualización (cambio de autoridades, nuevo convenio, fecha de beca) requería editar código HTML o subir archivos vía FTP / SMB a ciegas.
2. **Falta de base de datos:** A pesar de existir una rica base histórica de convenios (`BASE_GENERAL_DE_CONVENIOS.xls`), no existía motor relacional para consultas dinámicas, auditoría de cambios ni control de estados editoriales (Borrador / Aprobado / Publicado).
3. **No responsive moderno ni accesibilidad WCAG:** El sitio original no contaba con navegación accesible por teclado, navegación accesible para lectores de pantalla ni tokens de diseño escalables.
4. **Desconexión con el portal central y URLs rígidas:** Las rutas `.htm` no tenían metadatos dinámicos Open Graph, ni URLs canónicas, ni sitemap XML.

---

## 3. Elementos a Conservar vs. Elementos a Reestructurar

| Tipo de Contenido | Decisión | Justificación |
|---|---|---|
| **Convenios Internacionales (67 acuerdos)** | **Conservar y migrar a MySQL** | Patrimonio institucional activo con universidades de 19 países. Los PDFs se indexan y conservan. |
| **Convenios Nacionales (10 acuerdos)** | **Conservar y migrar a MySQL** | Convenios marco y específicos con universidades peruanas. |
| **Identidad Visual UNALM / OGI** | **Conservar fielmente** | Escudo institucional oficial de la UNALM y logotipo de la OGI sin deformaciones ni alteraciones. |
| **Aliados Estratégicos (APCI, JICA, etc.)** | **Conservar y modernizar** | Logotipos oficiales de agencias y embajadas aliadas. |
| **Guías de Intercambio y Movilidad** | **Conservar y estructurar** | Guía del alumno de intercambio y requisitos oficiales para entrantes y salientes. |
| **Archivos HTML estáticos heredados** | **Reemplazar por Laravel Blade** | Se sustituyen por vistas dinámicas optimizadas con SSR, SEO y base de datos. |
| **Archivos `Thumbs.db` y `_notes/`** | **Descartar** | Archivos basura de sistemas operativos y Dreamweaver. |

---

## 4. Arquitectura de Información Propuesta (Mapa de URLs)

| URL Heredada (`/rectorado/ORI/`) | URL Propuesta en Portal OGI | Módulo Funcional |
|---|---|---|
| `index.htm` | `/` | Portada con Hero, Convocatorias, Accesos Rápidos, Cifras y Noticias |
| `presentacion.htm` | `/la-ogi/presentacion` | Propósito institucional y directivos |
| `vision_mision.htm` | `/la-ogi/mision-vision` | Misión, Visión, Valores y Funciones oficiales |
| *(Nueva)* | `/la-ogi/equipo` | Equipo de gestión OGI con cargos y contactos oficiales |
| `convenios_internacionales.htm` | `/convenios/internacionales` | Directorio con filtros por país, tipo y vigencia |
| `convenios_nacionales.htm` | `/convenios/nacionales` | Directorio nacional con buscador y descarga oficial |
| `redes_internacionales.htm` | `/convenios/redes-internacionales` | Redes globales de cooperación científica |
| `redes_nacionales.htm` | `/convenios/redes-nacionales` | Redes interuniversitarias peruanas |
| `estudia_extranjero.htm` | `/movilidad/saliente` | Guía paso a paso para estudiantes UNALM |
| `estudia_unalm.htm` | `/movilidad/entrante` | Guía para estudiantes internacionales (ES/EN) |
| `excelencia_academica.htm` | `/convocatorias/excelencia-academica` | Programa BEAI y resoluciones |
| `beca_alianza_pacifico.htm` | `/becas-y-oportunidades/alianza-pacifico` | Convocatoria y becarios Alianza del Pacífico |
| `beca_santander.htm` | `/becas-y-oportunidades/santander` | Programa de becas Santander |
| `pronabec.htm` | `/becas-y-oportunidades/pronabec` | Oportunidades PRONABEC |
| `noticias.htm`, `nota1.htm`..`nota5.htm` | `/noticias-y-eventos` y `/noticias-y-eventos/{slug}` | Sala de prensa, comunicados y visitas protocolares |
| `testimonio_extranjeros.htm` | `/experiencias` | Testimonios y vivencias de movilidad |
| `visita_delegaciones.htm` | `/noticias-y-eventos?categoria=delegaciones` | Delegaciones y misiones internacionales |
| *(Nueva)* | `/recursos-y-documentos` | Reglamentos, formatos, directivas y boletines |
| *(Nueva)* | `/contacto` | Canales oficiales, anexos, horarios y ubicación |
| *(Nueva)* | `/intranet` (o `/admin`) | CMS institucional con roles y auditoría |

---

## 5. Decisiones Técnicas y Justificación del Stack

1. **Framework Backend: Laravel 12/13 sobre PHP 8.3.35:**
   - Permite un backend robusto, seguro, con Eloquent ORM, migraciones repetibles, middleware de roles/permisos (RBAC), protección nativa CSRF/XSS y compatibilidad con el entorno Windows Server/IIS de la UNALM.
2. **Base de Datos: MySQL (`ogi_web` en `172.16.0.189`):**
   - Aloja usuarios, roles, permisos, convenios, instituciones, convocatorias, noticias, traducciones y registros de auditoría.
3. **Frontend: Blade Templates + SSR + Tailwind CSS + Vanilla JS:**
   - Carga inicial ultrarrápida, indexación SEO perfecta por motores de búsqueda, cero hidratación pesada de SPAs y facilidad de mantenimiento institucional.
4. **Despliegue en Subdirectorio (`/pruebas1/david/OGI/`):**
   - Configuración de `APP_URL`, `ASSET_URL` y reglas IIS en `web.config` para operar sin fricción en el subdirectorio de pruebas institucional.
5. **Almacenamiento:**
   - Los documentos oficiales (PDFs) se sirven desde el sistema de archivos del servidor bajo `/storage/` o `/public/documentos/` con enlaces permanentes y nombres normalizados.
