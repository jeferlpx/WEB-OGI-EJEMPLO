# Procedimiento de Respaldo y Restauración (Backup & Disaster Recovery)
## Oficina de Gestión Interinstitucional y Asuntos Globales (OGI) — UNALM
### Base de Datos `ogi_web` (172.16.0.189) y Activos Digitales

---

### 1. Política General de Respaldo

Para asegurar la continuidad del servicio institucional y proteger la información histórica de convenios, convocatorias y registros de auditoría de la OGI, se establece el siguiente esquema de copias de seguridad:

| Elemento | Tipo de Respaldo | Frecuencia Recomendada | Retención |
|---|---|---|---|
| **Base de Datos MySQL (`ogi_web`)** | Dump SQL completo (`mysqldump`) | Diario (automatizado en la madrugada) | 30 días locales / 90 días en NAS |
| **Documentos Digitales (`public/documentos/`)** | Copia diferencial / incremental | Semanal o ante nuevas cargas | 1 año |
| **Código Fuente y Configuración (`.env`)** | Snapshot / Git commit | Ante cada actualización de versión | Permanente |

---

### 2. Generación Manual de Respaldos

#### 2.1 Respaldo de la Base de Datos MySQL
Desde una terminal de administración o servidor con acceso a la red interna `172.16.0.189`:

```bash
# Comando estándar con mysqldump
mysqldump -h 172.16.0.189 -u user_ogi -pogi2026$ \
  --single-transaction \
  --quick \
  --routines \
  --triggers \
  --default-character-set=utf8mb4 \
  ogi_web > "backup_ogi_web_$(date +%Y%m%d_%H%M%S).sql"
```

> **Nota:** La opción `--single-transaction` garantiza que el respaldo sea consistente sin necesidad de bloquear las tablas ni interrumpir la navegación en el portal público.

#### 2.2 Respaldo de Archivos y Documentos PDF
Los documentos oficiales de convenios y resoluciones residen en `public/documentos/`. Para respaldarlos en un archivo comprimido ZIP:

**En Windows PowerShell:**
```powershell
Compress-Archive -Path "Z:\pruebas1\David\OGI\public\documentos\*" -DestinationPath "D:\Backups_OGI\documentos_$(Get-Date -Format 'yyyyMMdd').zip" -Force
```

**En Linux / Bash:**
```bash
tar -czvf "backup_documentos_$(date +%Y%m%d).tar.gz" -C "/ruta/OGI/public/documentos" .
```

---

### 3. Procedimiento de Restauración (Disaster Recovery)

En caso de fallo en el servidor, corrupción de datos o necesidad de revertir a una fecha previa:

#### 3.1 Restauración de la Base de Datos
1. Asegurarse de que el servicio MySQL en `172.16.0.189` se encuentre activo y accesible.
2. (Opcional, pero recomendado) Crear la base de datos limpia si se está recreando desde cero:
   ```sql
   DROP DATABASE IF EXISTS ogi_web;
   CREATE DATABASE ogi_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Ejecutar la importación del archivo `.sql`:
   ```bash
   mysql -h 172.16.0.189 -u user_ogi -pogi2026$ --default-character-set=utf8mb4 ogi_web < backup_ogi_web_20261027_100000.sql
   ```
4. Verificar la integridad de los datos consultando el conteo de tablas y registros:
   ```sql
   USE ogi_web;
   SELECT 'agreements' AS tabla, COUNT(*) AS total FROM agreements
   UNION ALL
   SELECT 'calls', COUNT(*) FROM calls
   UNION ALL
   SELECT 'users', COUNT(*) FROM users;
   ```

#### 3.2 Restauración de Documentos y Medios
1. Extraer el archivo ZIP o TAR en el directorio `public/documentos/`.
2. Verificar que el usuario del pool de IIS (`IIS_IUSRS`) o el servidor web (`www-data`) tenga permisos de lectura y ejecución sobre la carpeta y los archivos extraídos:
   ```powershell
   icacls "Z:\pruebas1\David\OGI\public\documentos" /grant "IIS_IUSRS:(OI)(CI)RX" /T
   ```

#### 3.3 Verificación Posterior a la Restauración
Una vez restaurados la base de datos y los archivos:
1. Limpiar la caché de la aplicación en caso de ser necesario:
   ```bash
   php artisan cache:clear
   php artisan view:clear
   ```
2. Acceder al portal público (`https://www.lamolina.edu.pe/pruebas1/david/OGI/public/`) y validar que la página principal, el listado de convenios y la descarga de un PDF de muestra funcionen correctamente.
3. Iniciar sesión en la intranet (`/public/intranet/login`) con un usuario autorizado para verificar la visualización del dashboard.

---

### 4. Automatización con Tarea Programada de Windows (Windows Task Scheduler)

Para automatizar la copia de seguridad diaria en el servidor institucional, se proporciona el siguiente script en PowerShell (`backup_diario_ogi.ps1`):

```powershell
# ==============================================================================
# Script de Backup Automático Diario - OGI UNALM
# ==============================================================================
$Fecha = Get-Date -Format "yyyyMMdd_HHmmss"
$BackupDir = "D:\Backups_Institucionales\OGI"
$MysqlDumpPath = "C:\Program Files\MySQL\MySQL Server 8.0\bin\mysqldump.exe"

# Crear directorio si no existe
if (!(Test-Path -Path $BackupDir)) {
    New-Item -ItemType Directory -Path $BackupDir | Out-Null
}

# 1. Backup de Base de Datos MySQL
$SqlFile = "$BackupDir\ogi_web_$Fecha.sql"
& $MysqlDumpPath -h 172.16.0.189 -u user_ogi -pogi2026$ --single-transaction --quick ogi_web > $SqlFile

# Comprimir SQL
Compress-Archive -Path $SqlFile -DestinationPath "$SqlFile.zip" -Force
Remove-Item $SqlFile

# 2. Eliminar backups locales con más de 30 días de antigüedad
Get-ChildItem -Path $BackupDir -Filter "*.zip" | Where-Object { $_.CreationTime -lt (Get-Date).AddDays(-30) } | Remove-Item

Write-Host "Respaldo OGI completado exitosamente: $Fecha"
```

---
**Oficina de Gestión Interinstitucional y Asuntos Globales (OGI)**  
Oficina de Tecnologías de la Información y Comunicaciones (OTIC)  
Universidad Nacional Agraria La Molina — 2026
