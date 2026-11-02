<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\CallController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\CustomPageController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas del Portal OGI
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'home'])->name('home');

Route::prefix('la-ogi')->group(function () {
    Route::get('/presentacion', [PublicController::class, 'presentation'])->name('ogi.presentation');
    Route::get('/mision-vision', [PublicController::class, 'missionVision'])->name('ogi.mission_vision');
    Route::get('/equipo', [PublicController::class, 'team'])->name('ogi.team');
});

Route::prefix('convenios')->group(function () {
    Route::get('/internacionales', [PublicController::class, 'internationalAgreements'])->name('agreements.international');
    Route::get('/nacionales', [PublicController::class, 'nationalAgreements'])->name('agreements.national');
    Route::get('/redes', [PublicController::class, 'networks'])->name('agreements.networks');
});

Route::prefix('movilidad')->group(function () {
    // Movilidad Saliente (Outcoming)
    Route::get('/saliente', [PublicController::class, 'outgoingMobility'])->name('mobility.outgoing');
    Route::get('/saliente/excelencia-academica', [PublicController::class, 'academicExcellence'])->name('mobility.excellence');
    Route::get('/saliente/beca-alianza-pacifico', [PublicController::class, 'pacificAlliance'])->name('mobility.pacific_alliance');

    // Movilidad Entrante (Incoming)
    Route::get('/entrante', [PublicController::class, 'incomingMobility'])->name('mobility.incoming');
    Route::get('/entrante/programas-especiales', [PublicController::class, 'specialPrograms'])->name('mobility.special_programs');
    Route::get('/entrante/testimonios', [PublicController::class, 'foreignTestimonies'])->name('mobility.testimonies');
    Route::get('/entrante/visita-delegaciones', [PublicController::class, 'delegationVisits'])->name('mobility.delegations');

    // Summer Camp
    Route::get('/summer-camp', [PublicController::class, 'summerCamp'])->name('mobility.summer_camp');
});

// Alias directo para Summer Camp
Route::get('/summer-camp', fn() => redirect()->route('mobility.summer_camp'));

Route::get('/becas-y-convocatorias', [PublicController::class, 'callsIndex'])->name('calls.index');
Route::get('/becas-y-convocatorias/{slug}', [PublicController::class, 'callShow'])->name('calls.show');

Route::get('/noticias-y-eventos', [PublicController::class, 'newsIndex'])->name('news.index');
Route::get('/noticias-y-eventos/{slug}', [PublicController::class, 'newsShow'])->name('news.show');

Route::get('/recursos-y-documentos', [PublicController::class, 'resourcesIndex'])->name('resources.index');
Route::get('/contacto', [PublicController::class, 'contact'])->name('contact');

// Páginas Institucionales Dinámicas (Redes Internacionales, Nacionales, Cooperación)
Route::get('/pagina/{slug}', [PublicController::class, 'customPage'])->name('pages.show');

Route::get('/idioma/{locale}', [PublicController::class, 'setLocale'])->name('locale.switch');

/*
|--------------------------------------------------------------------------
| Rutas Administrativas / Intranet CMS
|--------------------------------------------------------------------------
*/

Route::prefix('intranet')->group(function () {
    // Autenticación
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Panel con protección de autenticación y RBAC
    Route::middleware(['auth', 'role:superadmin,admin_ogi,editor,revisor,publicador,consulta'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/dashboard', fn() => redirect()->route('admin.dashboard'));

        // Convenios
        Route::resource('convenios', AgreementController::class)->names('admin.agreements')->parameters(['convenios' => 'agreement']);

        // Convocatorias
        Route::resource('convocatorias', CallController::class)->names('admin.calls')->parameters(['convocatorias' => 'call']);

        // Noticias
        Route::resource('noticias', NewsController::class)->names('admin.news')->parameters(['noticias' => 'news']);

        // Recursos y Documentos
        Route::resource('recursos', ResourceController::class)->names('admin.resources')->parameters(['recursos' => 'resource']);

        // Aliados Estratégicos y Redes
        Route::resource('aliados', PartnerController::class)->names('admin.partners')->parameters(['aliados' => 'partner']);

        // Directorio / Equipo de Gestión OGI
        Route::resource('equipo', TeamController::class)->names('admin.team')->parameters(['equipo' => 'team']);

        // Páginas Personalizadas y Navegación (Redes, Cooperación, Secciones)
        Route::resource('paginas', CustomPageController::class)->names('admin.pages')->parameters(['paginas' => 'page']);

        // Configuración y Contenido Institucional
        Route::get('/ajustes', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/ajustes', [SettingController::class, 'update'])->name('admin.settings.update');
        Route::post('/ajustes/upload-video', [SettingController::class, 'uploadVideoAjax'])->name('admin.settings.upload_video');
        Route::post('/ajustes/select-video', [SettingController::class, 'selectVideo'])->name('admin.settings.select_video');
        Route::post('/ajustes/upload-banner', [SettingController::class, 'uploadBannerAjax'])->name('admin.settings.upload_banner');
        Route::post('/ajustes/delete-banner/{id}', [SettingController::class, 'deleteBannerAjax'])->name('admin.settings.delete_banner');
        Route::post('/ajustes/toggle-banner-carousel/{id}', [SettingController::class, 'toggleBannerCarousel'])->name('admin.settings.toggle_banner_carousel');
        Route::post('/ajustes/select-banner-featured/{id}', [SettingController::class, 'selectBannerFeatured'])->name('admin.settings.select_banner_featured');
        Route::post('/ajustes/reorder-banner/{id}', [SettingController::class, 'reorderBanner'])->name('admin.settings.reorder_banner');

        // Auditoría
        Route::get('/auditoria', [AuditController::class, 'index'])->name('admin.audit.index');

        // Auto-Traducción Inteligente para la Intranet
        Route::post('/api/translate', [AdminController::class, 'autoTranslate'])->name('admin.api.translate');

        // Gestión de Usuarios (Exclusivo Superadmin)
        Route::middleware('role:superadmin')->group(function () {
            Route::resource('usuarios', UserController::class)->names('admin.users')->parameters(['usuarios' => 'user']);
        });
    });
});
