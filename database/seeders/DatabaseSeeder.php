<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Country;
use App\Models\AgreementType;
use App\Models\Institution;
use App\Models\Agreement;
use App\Models\Call;
use App\Models\News;
use App\Models\Resource;
use App\Models\Faq;
use App\Models\TeamMember;
use App\Models\Partner;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuarios con roles (RBAC)
        $users = [
            [
                'name' => 'Super Administrador UNALM',
                'email' => 'admin@lamolina.edu.pe',
                'password' => Hash::make('OGI2026!Admin'),
                'role' => 'superadmin',
            ],
            [
                'name' => 'Dr. Christian René Encina Zelada',
                'email' => 'director.ogi@lamolina.edu.pe',
                'password' => Hash::make('OGI2026!Director'),
                'role' => 'admin_ogi',
            ],
            [
                'name' => 'Lic. Ángela Chamorro (Editora OGI)',
                'email' => 'editor.ogi@lamolina.edu.pe',
                'password' => Hash::make('OGI2026!Editor'),
                'role' => 'editor',
            ],
            [
                'name' => 'Comisión Revisora Institucional',
                'email' => 'revisor.ogi@lamolina.edu.pe',
                'password' => Hash::make('OGI2026!Revisor'),
                'role' => 'revisor',
            ],
            [
                'name' => 'Coordinación Editorial y Publicación',
                'email' => 'publicador.ogi@lamolina.edu.pe',
                'password' => Hash::make('OGI2026!Publicador'),
                'role' => 'publicador',
            ],
            [
                'name' => 'Auditoría y Consulta OTIC',
                'email' => 'consulta.ogi@lamolina.edu.pe',
                'password' => Hash::make('OGI2026!Auditor'),
                'role' => 'consulta',
            ],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(['email' => $u['email']], $u);
        }

        // 2. Países
        $countriesData = [
            ['name' => 'Perú', 'code' => 'PE', 'flag_emoji' => '🇵🇪', 'region' => 'América del Sur'],
            ['name' => 'Alemania', 'code' => 'DE', 'flag_emoji' => '🇩🇪', 'region' => 'Europa'],
            ['name' => 'Argentina', 'code' => 'AR', 'flag_emoji' => '🇦🇷', 'region' => 'América del Sur'],
            ['name' => 'Austria', 'code' => 'AT', 'flag_emoji' => '🇦🇹', 'region' => 'Europa'],
            ['name' => 'Brasil', 'code' => 'BR', 'flag_emoji' => '🇧🇷', 'region' => 'América del Sur'],
            ['name' => 'Chile', 'code' => 'CL', 'flag_emoji' => '🇨🇱', 'region' => 'América del Sur'],
            ['name' => 'Colombia', 'code' => 'CO', 'flag_emoji' => '🇨🇴', 'region' => 'América del Sur'],
            ['name' => 'Ecuador', 'code' => 'EC', 'flag_emoji' => '🇪🇨', 'region' => 'América del Sur'],
            ['name' => 'España', 'code' => 'ES', 'flag_emoji' => '🇪🇸', 'region' => 'Europa'],
            ['name' => 'Estados Unidos', 'code' => 'US', 'flag_emoji' => '🇺🇸', 'region' => 'América del Norte'],
            ['name' => 'Finlandia', 'code' => 'FI', 'flag_emoji' => '🇫🇮', 'region' => 'Europa'],
            ['name' => 'Francia', 'code' => 'FR', 'flag_emoji' => '🇫🇷', 'region' => 'Europa'],
            ['name' => 'Honduras', 'code' => 'HN', 'flag_emoji' => '🇭🇳', 'region' => 'América Central'],
            ['name' => 'India', 'code' => 'IN', 'flag_emoji' => '🇮🇳', 'region' => 'Asia'],
            ['name' => 'Italia', 'code' => 'IT', 'flag_emoji' => '🇮🇹', 'region' => 'Europa'],
            ['name' => 'Japón', 'code' => 'JP', 'flag_emoji' => '🇯🇵', 'region' => 'Asia'],
            ['name' => 'México', 'code' => 'MX', 'flag_emoji' => '🇲🇽', 'region' => 'América del Norte'],
            ['name' => 'Portugal', 'code' => 'PT', 'flag_emoji' => '🇵🇹', 'region' => 'Europa'],
            ['name' => 'Rusia', 'code' => 'RU', 'flag_emoji' => '🇷🇺', 'region' => 'Europa'],
            ['name' => 'Turquía', 'code' => 'TR', 'flag_emoji' => '🇹🇷', 'region' => 'Asia'],
        ];

        $countriesMap = [];
        foreach ($countriesData as $cd) {
            $c = Country::updateOrCreate(['name' => $cd['name']], $cd);
            $countriesMap[$cd['name']] = $c->id;
        }

        // 3. Tipos de Acuerdo
        $typesData = [
            ['name' => 'Convenio Marco de Cooperación Interinstitucional', 'description' => 'Acuerdo general de bases de colaboración y cooperación entre instituciones.'],
            ['name' => 'Convenio Específico de Movilidad Académica', 'description' => 'Intercambio semestral y anual para estudiantes de pregrado, posgrado y docentes.'],
            ['name' => 'Acuerdo de Cooperación Científica y Tecnológica', 'description' => 'Desarrollo de proyectos de I+D+i conjuntos, laboratorios compartidos y publicaciones.'],
            ['name' => 'Memorándum de Entendimiento (MoU)', 'description' => 'Declaración formal de intenciones y entendimiento interinstitucional.'],
            ['name' => 'Acuerdo de Doble Grado / Cotutela', 'description' => 'Programas formativos integrados con titulación conjunta o cotutela doctoral.'],
        ];

        $typesMap = [];
        foreach ($typesData as $td) {
            $t = AgreementType::updateOrCreate(['name' => $td['name']], $td);
            $typesMap[$td['name']] = $t->id;
        }

        $defaultTypeId = $typesMap['Convenio Marco de Cooperación Interinstitucional'] ?? 1;
        $mobilityTypeId = $typesMap['Convenio Específico de Movilidad Académica'] ?? 2;

        // 4. Sembrar Convenios Reales
        $seedJson = __DIR__ . '/data/agreements.json';
        if (file_exists($seedJson)) {
            $agreements = json_decode(file_get_contents($seedJson), true);
            foreach ($agreements as $idx => $agr) {
                $countryId = $countriesMap[$agr['country']] ?? ($agr['scope'] === 'nacional' ? $countriesMap['Perú'] : $countriesMap['España']);
                
                $inst = Institution::firstOrCreate(
                    ['name' => $agr['institution']],
                    [
                        'country_id' => $countryId,
                        'type' => 'universidad',
                        'city' => $agr['country'],
                    ]
                );

                $code = ($agr['scope'] === 'nacional' ? 'CN-' : 'CI-') . str_pad($idx + 1, 3, '0', STR_PAD_LEFT) . '-UNALM';
                
                Agreement::updateOrCreate(
                    ['code' => $code],
                    [
                        'title' => $agr['title'],
                        'institution_id' => $inst->id,
                        'agreement_type_id' => ($idx % 3 === 0) ? $mobilityTypeId : $defaultTypeId,
                        'scope' => $agr['scope'],
                        'faculty_scope' => ($idx % 4 === 0) ? 'Facultad de Agronomía y Ciencias' : 'Todas las facultades',
                        'objective' => 'Promover la cooperación académica, científica, el intercambio de estudiantes, docentes y la investigación conjunta en ciencias agrarias y ambientales.',
                        'signed_at' => now()->subYears(rand(1, 4))->subMonths(rand(1, 10)),
                        'expires_at' => ($idx % 5 === 0) ? null : now()->addYears(rand(1, 4)),
                        'is_indefinite' => ($idx % 5 === 0),
                        'status' => 'vigente',
                        'publication_status' => 'publicado',
                        'file_path' => $agr['file'],
                        'contact_unit' => 'Oficina de Gestión Interinstitucional (OGI)',
                    ]
                );
            }
        }

        // 5. Convocatorias y Becas Reales
        $callsData = [
            [
                'title' => 'Beca Alianza del Pacífico — Convocatoria de Movilidad Académica',
                'title_en' => 'Pacific Alliance Scholarship — Academic Mobility Call',
                'slug' => 'beca-alianza-del-pacifico',
                'call_type' => 'beca',
                'target_audience' => 'estudiantes_pregrado',
                'start_date' => now()->subMonths(1),
                'deadline_date' => now()->addMonths(2),
                'status' => 'abierta',
                'publication_status' => 'publicado',
                'is_featured' => true,
                'summary' => 'Programa de becas de movilidad estudiantil y docente entre Chile, Colombia, México y Perú para cursar un semestre académico.',
                'summary_en' => 'Student and faculty mobility scholarship program between Chile, Colombia, Mexico, and Peru for an academic semester.',
                'description' => '<p>La Plataforma de Movilidad Estudiantil y Académica de la Alianza del Pacífico otorga becas integrales para que estudiantes de pregrado de la UNALM realicen estudios durante un semestre académico en universidades de Chile, Colombia y México con convenio vigente.</p><h3>Beneficios:</h3><ul><li>Asignación mensual de sostenimiento.</li><li>Exoneración total de costos académicos en la universidad de destino.</li><li>Seguro de salud internacional.</li><li>Pasajes aéreos internacionales de ida y vuelta.</li></ul>',
                'requirements' => '<ul><li>Ser alumno regular de la UNALM con matrícula vigente.</li><li>Pertenecer como mínimo al tercio superior.</li><li>Haber aprobado al menos el 50% de los créditos de su plan de estudios.</li><li>No tener antecedentes disciplinarios.</li><li>Carta de aceptación o postulación respaldada por la OGI.</li></ul>',
                'requirements_file_path' => 'documentos/Lista_BEAI_2024.pdf',
                'apply_url' => 'https://becas.alianzapacifico.net/',
                'contact_email' => 'ogi@lamolina.edu.pe',
            ],
            [
                'title' => 'Beca Santander Movilidad Internacional de Pregrado',
                'title_en' => 'Santander International Undergraduate Mobility Scholarship',
                'slug' => 'beca-santander-movilidad-internacional',
                'call_type' => 'beca',
                'target_audience' => 'estudiantes_pregrado',
                'start_date' => now()->subWeeks(2),
                'deadline_date' => now()->addMonths(1),
                'status' => 'abierta',
                'publication_status' => 'publicado',
                'is_featured' => true,
                'summary' => 'Becas para realizar una estancia académica internacional de 6 meses en universidades socias de Iberoamérica.',
                'summary_en' => 'Scholarships for a 6-month international academic stay at partner universities in Ibero-America.',
                'description' => '<p>Santander Universidades apoya a la comunidad molinera facilitando la movilidad a prestigiosas universidades de España, Portugal y Latinoamérica con las que la UNALM mantiene convenios vigentes.</p>',
                'requirements' => '<ul><li>Alumnos con rendimiento académico sobresaliente (quinto o tercio superior).</li><li>Mínimo 50% de créditos aprobados.</li><li>Carta de motivación y respaldo de la facultad.</li></ul>',
                'apply_url' => 'https://app.santanderopenacademy.com/',
                'contact_email' => 'ogi@lamolina.edu.pe',
            ],
            [
                'title' => 'Programa de Becas por Excelencia Académica Internacional (BEAI UNALM)',
                'title_en' => 'International Academic Excellence Scholarship Program (BEAI UNALM)',
                'slug' => 'programa-becas-excelencia-academica-beai',
                'call_type' => 'beca',
                'target_audience' => 'estudiantes_pregrado',
                'start_date' => now()->subMonths(2),
                'deadline_date' => now()->addDays(20),
                'status' => 'abierta',
                'publication_status' => 'publicado',
                'is_featured' => true,
                'summary' => 'Reconocimiento institucional y financiamiento para los mejores promedios de cada una de las 12 facultades de la UNALM.',
                'summary_en' => 'Institutional recognition and funding for top GPAs across all 12 UNALM faculties.',
                'description' => '<p>El Programa BEAI busca impulsar la internacionalización de los alumnos más destacados de la universidad, financiando estancias de investigación y semestres de intercambio en las mejores universidades del mundo.</p>',
                'requirements_file_path' => 'documentos/BEAI_2025.pdf',
                'contact_email' => 'ogi@lamolina.edu.pe',
            ],
            [
                'title' => 'Becas de Posgrado e Investigación — Comisión Fulbright',
                'title_en' => 'Fulbright Commission Postgraduate and Research Scholarships',
                'slug' => 'becas-comision-fulbright-investigacion',
                'call_type' => 'investigacion',
                'target_audience' => 'docentes',
                'start_date' => now()->subMonths(1),
                'deadline_date' => now()->addMonths(3),
                'status' => 'abierta',
                'publication_status' => 'publicado',
                'is_featured' => false,
                'summary' => 'Oportunidades de estancias de investigación posdoctoral y maestrías en universidades líderes de los Estados Unidos.',
                'summary_en' => 'Opportunities for postdoctoral research visits and masters degrees at leading US universities.',
                'description' => '<p>Dirigido a docentes, investigadores y graduados de la UNALM en áreas estratégicas de biotecnología, agronomía, gestión de recursos hídricos y cambio climático.</p>',
                'apply_url' => 'https://www.fulbright.pe/',
                'contact_email' => 'ogi@lamolina.edu.pe',
            ],
            [
                'title' => 'Programa de Cooperación JICA Japón — Becas de Posgrado y Cursos Técnicos',
                'title_en' => 'JICA Japan Cooperation Program — Postgraduate Scholarships and Technical Courses',
                'slug' => 'programa-cooperacion-jica-japon',
                'call_type' => 'curso_corto',
                'target_audience' => 'todos',
                'start_date' => now()->subMonths(3),
                'deadline_date' => now()->subDays(5),
                'status' => 'cerrada',
                'publication_status' => 'publicado',
                'is_featured' => false,
                'summary' => 'Convocatoria anual de capacitación técnica en Japón en gestión de cuencas y desarrollo agrícola sustentable.',
                'summary_en' => 'Annual technical training in Japan on watershed management and sustainable agricultural development.',
                'description' => '<p>Capacitación internacional para profesionales molineros impartida en centros de investigación japoneses.</p>',
                'contact_email' => 'ogi@lamolina.edu.pe',
            ],
        ];

        foreach ($callsData as $cd) {
            Call::updateOrCreate(['slug' => $cd['slug']], $cd);
        }

        // 6. Noticias Reales
        $newsData = [
            [
                'title' => 'UNALM firma convenio de cooperación interinstitucional con la Municipalidad Distrital de Mazamari',
                'title_en' => 'UNALM signs inter-institutional cooperation agreement with Mazamari District Municipality',
                'slug' => 'unalm-firma-convenio-con-municipalidad-de-mazamari',
                'category' => 'convenio',
                'published_at' => now()->subDays(15),
                'is_featured' => true,
                'summary' => 'El acuerdo impulsará la investigación agroforestal, la transferencia tecnológica y el desarrollo sustentable en la selva central del Perú.',
                'summary_en' => 'The agreement will foster agroforestry research, technology transfer, and sustainable development in the central jungle of Peru.',
                'content' => '<p>La Universidad Nacional Agraria La Molina, a través de la Oficina de Gestión Interinstitucional y Asuntos Globales (OGI), suscribió un trascendental Convenio Marco de Cooperación con la Municipalidad Distrital de Mazamari (Satipo, Junín).</p><p>El objetivo central del acuerdo es el desarrollo conjunto de programas de investigación en café, cacao, cítricos y recursos forestales nativos, promoviendo la capacitación de agricultores locales y estancias de prácticas preprofesionales para estudiantes molineros.</p>',
                'author_name' => 'Oficina de Gestión Interinstitucional',
                'publication_status' => 'publicado',
            ],
            [
                'title' => 'Fortalecimiento de la vinculación Academia-Empresa: UNALM y Leche Gloria impulsan innovación ganadera',
                'title_en' => 'Strengthening Academy-Industry Linkage: UNALM and Leche Gloria boost livestock innovation',
                'slug' => 'vinculacion-academia-empresa-unalm-leche-gloria',
                'category' => 'cooperacion',
                'published_at' => now()->subDays(30),
                'is_featured' => true,
                'summary' => 'Alianza estratégica permitirá proyectos de I+D en nutrición animal, mejoramiento genético y sostenibilidad del sector lechero.',
                'summary_en' => 'Strategic partnership enables R&D projects in animal nutrition, genetic improvement, and dairy sustainability.',
                'content' => '<p>En el marco del plan de internacionalización y vinculación productiva, la UNALM y Leche Gloria consolidaron una agenda técnica conjunta para promover pasantías profesionales, investigación aplicada y optimización de cadenas de valor lácteas a nivel nacional.</p>',
                'author_name' => 'Oficina de Gestión Interinstitucional',
                'publication_status' => 'publicado',
            ],
            [
                'title' => 'Firma de convenio marco con la Mancomunidad Municipal Tres Cuencas (Santa-Fortaleza-Pativilca, Áncash)',
                'title_en' => 'Signing of framework agreement with Tres Cuencas Municipal Commonwealth (Ancash)',
                'slug' => 'convenio-mancomunidad-tres-cuencas-ancash',
                'category' => 'convenio',
                'published_at' => now()->subMonths(2),
                'is_featured' => false,
                'summary' => 'Protección de cuencas altoandinas, seguridad alimentaria y gestión hídrica eficiente en la región Áncash.',
                'summary_en' => 'High-Andean watershed protection, food security, and efficient water management in Ancash.',
                'content' => '<p>La UNALM asesorará técnicamente a las municipalidades integrantes de la Mancomunidad en la formulación de proyectos agrícolas sustentables, siembra y cosecha de agua, y desarrollo de cultivos andinos de alto valor nutricional.</p>',
                'author_name' => 'Oficina de Gestión Interinstitucional',
                'publication_status' => 'publicado',
            ],
            [
                'title' => 'Convenio de Cooperación con la Municipalidad Distrital de Kimbiri — VRAEM Cusco',
                'title_en' => 'Cooperation Agreement with Kimbiri District Municipality — VRAEM Cusco',
                'slug' => 'convenio-municipalidad-kimbiri-vraem-cusco',
                'category' => 'convenio',
                'published_at' => now()->subMonths(3),
                'is_featured' => false,
                'summary' => 'Fomento de cadenas productivas sostenibles y capacitación agropecuaria en el Valle de los Ríos Apurímac, Ene y Mantaro.',
                'summary_en' => 'Fostering sustainable productive chains and agricultural training in the VRAEM valley.',
                'content' => '<p>El convenio promueve la instalación de parcelas demostrativas, pasantías y el fortalecimiento de capacidades para jóvenes técnicos y productores de la cuenca del VRAEM.</p>',
                'author_name' => 'Oficina de Gestión Interinstitucional',
                'publication_status' => 'publicado',
            ],
            [
                'title' => 'Delegación de la Universidad Politécnica de Madrid visita campus de la UNALM para ampliar movilidad docente',
                'title_en' => 'Polytechnic University of Madrid delegation visits UNALM campus to expand faculty mobility',
                'slug' => 'visita-delegacion-universidad-politecnica-madrid',
                'category' => 'delegacion',
                'published_at' => now()->subMonths(4),
                'is_featured' => false,
                'summary' => 'Representantes de la UPM y autoridades de la UNALM acordaron nuevas plazas para doble titulación y cotutela doctoral.',
                'summary_en' => 'UPM representatives and UNALM leadership agreed on new slots for double degrees and doctoral co-tutelle.',
                'content' => '<p>En una productiva sesión de trabajo en el Rectorado de la UNALM, se revisaron los avances del convenio bilateral con la Escuela Técnica Superior de Ingeniería Agronómica, Alimentaria y de Biosistemas de Madrid.</p>',
                'author_name' => 'Oficina de Gestión Interinstitucional',
                'publication_status' => 'publicado',
            ],
        ];

        foreach ($newsData as $nd) {
            News::updateOrCreate(['slug' => $nd['slug']], $nd);
        }

        // 7. Recursos y Documentos Descargables
        $resourcesData = [
            [
                'title' => 'Guía del Alumno de Intercambio Internacional — UNALM',
                'title_en' => 'International Exchange Student Handbook — UNALM',
                'category' => 'guia',
                'target_audience' => 'estudiantes_entrantes',
                'file_path' => 'documentos/Guia_del_alumno_de_intercambio.pdf',
                'file_size_kb' => 4938,
                'file_ext' => 'pdf',
                'description' => 'Guía completa con información de bienvenida, trámites de visa de estudiante, seguro médico, servicios del campus, alojamiento y vida estudiantil en Lima.',
            ],
            [
                'title' => 'Consolidado Oficial de Convenios Internacionales Vigentes',
                'title_en' => 'Official Consolidated Directory of Active International Agreements',
                'category' => 'resolucion',
                'target_audience' => 'general',
                'file_path' => 'documentos/Convenios_Internacionales_Consolidado.pdf',
                'file_size_kb' => 147,
                'file_ext' => 'pdf',
                'description' => 'Listado formal de instituciones, países y vigencia de acuerdos internacionales suscritos por la UNALM.',
            ],
            [
                'title' => 'Consolidado Oficial de Convenios Nacionales Vigentes',
                'title_en' => 'Official Consolidated Directory of Active National Agreements',
                'category' => 'resolucion',
                'target_audience' => 'general',
                'file_path' => 'documentos/Convenios_Nacionales_Consolidado.pdf',
                'file_size_kb' => 159,
                'file_ext' => 'pdf',
                'description' => 'Catálogo de acuerdos de cooperación con universidades, ministerios, gobiernos regionales y empresas peruanas.',
            ],
            [
                'title' => 'Bases y Lista de Ganadores BEAI — Excelencia Académica Internacional',
                'title_en' => 'BEAI Guidelines and Awardees List — International Academic Excellence',
                'category' => 'formato',
                'target_audience' => 'estudiantes_salientes',
                'file_path' => 'documentos/Lista_BEAI_2024.pdf',
                'file_size_kb' => 180,
                'file_ext' => 'pdf',
                'description' => 'Directiva y resultados de selección para becas de movilidad internacional por mérito académico.',
            ],
            [
                'title' => 'Boletín Molinero de Cooperación Internacional — Edición Especial',
                'title_en' => 'Molinero International Cooperation Bulletin — Special Edition',
                'category' => 'boletin',
                'target_audience' => 'general',
                'file_path' => 'documentos/BOLETIN_MOLINERO_4_2019.pdf',
                'file_size_kb' => 4127,
                'file_ext' => 'pdf',
                'description' => 'Publicación informativa con testimonios de estudiantes, convenios emblemáticos y proyectos de investigación transnacionales.',
            ],
        ];

        foreach ($resourcesData as $rd) {
            Resource::updateOrCreate(['title' => $rd['title']], $rd);
        }

        // 8. Equipo Directivo y Técnico OGI
        $teamData = [
            [
                'name' => 'Dr. Christian René Encina Zelada',
                'role_title' => 'Director de la Oficina de Gestión Interinstitucional y Asuntos Globales',
                'role_title_en' => 'Director of the Office of Inter-institutional Management and Global Affairs',
                'department' => 'Dirección General',
                'email' => 'cencina@lamolina.edu.pe',
                'phone' => '(01) 614-7800 Anexo 212',
                'bio' => 'Doctor e Investigador Renacyt con amplia trayectoria en gestión universitaria, cooperación académica internacional y proyectos de ciencia aplicada.',
                'order' => 1,
            ],
            [
                'name' => 'Lic. Ángela Chamorro',
                'role_title' => 'Coordinadora de Movilidad Académica y Becas',
                'role_title_en' => 'Academic Mobility and Scholarships Coordinator',
                'department' => 'Movilidad Estudiantil y Docente',
                'email' => 'achamorro@lamolina.edu.pe',
                'phone' => '(01) 614-7800 Anexo 215',
                'bio' => 'Especialista en asesoría integral de becas de intercambio, gestión de postulaciones para alumnos entrantes/salientes y convenios multilaterales.',
                'order' => 2,
            ],
            [
                'name' => 'Lic. Julissa Sánchez',
                'role_title' => 'Especialista en Convenios y Redes Interinstitucionales',
                'role_title_en' => 'Agreements and Inter-institutional Networks Specialist',
                'department' => 'Convenios y Redes',
                'email' => 'jsanchez@lamolina.edu.pe',
                'phone' => '(01) 614-7800 Anexo 218',
                'bio' => 'Gestión técnico-legal y seguimiento de la vigencia de acuerdos marco y específicos nacionales e internacionales de la UNALM.',
                'order' => 3,
            ],
            [
                'name' => 'Lic. Pamela Soria',
                'role_title' => 'Asistente de Cooperación y Gestión de Proyectos',
                'role_title_en' => 'Cooperation and Project Management Assistant',
                'department' => 'Cooperación Global',
                'email' => 'psoria@lamolina.edu.pe',
                'phone' => '(01) 614-7800 Anexo 219',
                'bio' => 'Apoyo en convocatorias internacionales, seguimiento a misiones diplomáticas y relaciones con agencias cooperantes.',
                'order' => 4,
            ],
        ];

        foreach ($teamData as $td) {
            TeamMember::updateOrCreate(['email' => $td['email']], $td);
        }

        // 9. Aliados Estratégicos
        $partnersData = [
            [
                'name' => 'Agencia Peruana de Cooperación Internacional (APCI)',
                'category' => 'agencia_cooperacion',
                'logo_path' => 'imagenes/apci.jpg',
                'website_url' => 'https://www.apci.gob.pe/',
                'description' => 'Entidad rectora de la cooperación técnica internacional en el Perú.',
                'order' => 1,
            ],
            [
                'name' => 'Comisión Fulbright Perú',
                'category' => 'agencia_cooperacion',
                'logo_path' => 'imagenes/Comision_Fulbright.jpg',
                'website_url' => 'https://www.fulbright.pe/',
                'description' => 'Promoción del intercambio educativo y científico entre el Perú y los Estados Unidos.',
                'order' => 2,
            ],
            [
                'name' => 'Japan International Cooperation Agency (JICA)',
                'category' => 'agencia_cooperacion',
                'logo_path' => 'imagenes/JICA.jpg',
                'website_url' => 'https://www.jica.go.jp/peru/espanol/',
                'description' => 'Apoyo al desarrollo socioeconómico y ambiental a través de la cooperación japonesa.',
                'order' => 3,
            ],
            [
                'name' => 'Korea International Cooperation Agency (KOICA)',
                'category' => 'agencia_cooperacion',
                'logo_path' => 'imagenes/koika.jpg',
                'website_url' => 'https://www.koica.go.kr/',
                'description' => 'Agencia gubernamental de la República de Corea para programas de desarrollo y becas técnicas.',
                'order' => 4,
            ],
            [
                'name' => 'PRONABEC',
                'category' => 'agencia_cooperacion',
                'logo_path' => 'imagenes/PRONABEC.jpg',
                'website_url' => 'https://www.pronabec.gob.pe/',
                'description' => 'Programa Nacional de Becas y Crédito Educativo del Ministerio de Educación del Perú.',
                'order' => 5,
            ],
            [
                'name' => 'Embajada de los Estados Unidos en el Perú',
                'category' => 'embajada',
                'logo_path' => 'imagenes/embajada_usa.jpg',
                'website_url' => 'https://pe.usembassy.gov/es/',
                'description' => 'Alianzas educativas, científicas y programas de desarrollo cultural conjunto.',
                'order' => 6,
            ],
        ];

        foreach ($partnersData as $pd) {
            Partner::updateOrCreate(['name' => $pd['name']], $pd);
        }

        // 10. Preguntas Frecuentes (FAQs)
        $faqsData = [
            [
                'category' => 'movilidad_saliente',
                'question' => '¿Cuáles son los requisitos básicos para postular a un intercambio académico internacional?',
                'question_en' => 'What are the basic requirements to apply for an international academic exchange?',
                'answer' => 'Los requisitos principales son: ser estudiante regular con matrícula vigente en la UNALM, haber aprobado al menos el 50% de los créditos de su carrera profesional, pertenecer como mínimo al tercio superior de su facultad, no registrar sanciones disciplinarias y contar con la aprobación del plan de convalecencia de cursos por parte de su Decanato.',
                'answer_en' => 'The main requirements are: being a regular registered student at UNALM, having completed at least 50% of your curriculum credits, ranking in the upper third of your class, having no disciplinary records, and having approved course validation by your Deanery.',
                'order' => 1,
            ],
            [
                'category' => 'movilidad_entrante',
                'question' => 'How can an international student apply for a study abroad semester at UNALM?',
                'question_en' => 'How can an international student apply for a study abroad semester at UNALM?',
                'answer' => 'El estudiante debe ser nominado por la oficina de relaciones internacionales de su universidad de origen (la cual debe mantener convenio vigente con la UNALM). Deberá presentar el formulario de postulación de la OGI, su certificado de notas oficial, carta de motivación, copia de pasaporte y propuesta de cursos de interés en alguna de nuestras 12 carreras profesionales.',
                'answer_en' => 'The student must be officially nominated by their home university\'s international office (which must have an active agreement with UNALM). They need to submit the OGI application form, official transcript, motivation letter, passport copy, and proposed courses from our 12 undergraduate degree programs.',
                'order' => 2,
            ],
            [
                'category' => 'convenios',
                'question' => '¿Cómo puede una universidad o institución extranjera proponer un nuevo convenio con la UNALM?',
                'question_en' => 'How can a foreign university or institution propose a new agreement with UNALM?',
                'answer' => 'La institución interesada debe remitir una carta de intención oficial dirigida a la Dirección de la OGI (correo: ogi@lamolina.edu.pe) adjuntando la propuesta borrador de convenio marco o específico, detallando los objetivos de cooperación mutua y las áreas académicas involucradas.',
                'answer_en' => 'The interested institution must send an official letter of intent addressed to the OGI Directorate (email: ogi@lamolina.edu.pe) attaching the draft framework or specific agreement, detailing mutual cooperation objectives and academic fields involved.',
                'order' => 3,
            ],
            [
                'category' => 'becas',
                'question' => '¿Las becas de movilidad cubren el 100% de los gastos del intercambio?',
                'question_en' => 'Do mobility scholarships cover 100% of all exchange expenses?',
                'answer' => 'Depende de la modalidad: en programas integrales como Alianza del Pacífico se cubren pasajes, seguro médico y estipendio mensual de alimentación/vivienda con exoneración de matrícula. En acuerdos bilaterales directos, se exonera la matrícula en la universidad socia, pero el estudiante debe financiar sus pasajes y sostenimiento personal a menos que acceda a fondos complementarios como el BEAI.',
                'answer_en' => 'It depends on the program: comprehensive schemes like Pacific Alliance cover flights, health insurance, and monthly stipends alongside tuition waivers. In bilateral agreements, tuition is waived at the host university, but students cover their own travel and living expenses unless awarded complementary institutional grants like BEAI.',
                'order' => 4,
            ],
        ];

        foreach ($faqsData as $fd) {
            Faq::updateOrCreate(['question' => $fd['question']], $fd);
        }

        // 11. Configuración de Sitio (Site Settings)
        $settingsData = [
            ['key' => 'hero_badge', 'value' => 'Internacionalización & Cooperación Global', 'value_en' => 'Internationalization & Global Cooperation', 'group' => 'hero', 'label' => 'Insignia superior de Hero'],
            ['key' => 'hero_title', 'value' => 'Conectando el Conocimiento Molinero con el Mundo', 'value_en' => 'Connecting Molinero Knowledge with the World', 'group' => 'hero', 'label' => 'Título principal de Hero'],
            ['key' => 'hero_subtitle', 'value' => 'Lideramos la cooperación interinstitucional, la investigación científica transnacional y las oportunidades de movilidad académica para la comunidad de la Universidad Nacional Agraria La Molina.', 'value_en' => 'Leading inter-institutional cooperation, transnational scientific research, and academic mobility opportunities for the UNALM community.', 'group' => 'hero', 'label' => 'Subtítulo de Hero'],
            ['key' => 'stat_countries', 'value' => '19+', 'value_en' => '19+', 'group' => 'estadisticas', 'label' => 'Países Socios'],
            ['key' => 'stat_agreements', 'value' => '74+', 'value_en' => '74+', 'group' => 'estadisticas', 'label' => 'Convenios Activos'],
            ['key' => 'stat_faculties', 'value' => '12', 'value_en' => '12', 'group' => 'estadisticas', 'label' => 'Carreras Profesionales'],
            ['key' => 'stat_allies', 'value' => '6+', 'value_en' => '6+', 'group' => 'estadisticas', 'label' => 'Redes y Agencias Aliadas'],
            ['key' => 'contact_email', 'value' => 'ogi@lamolina.edu.pe', 'value_en' => 'ogi@lamolina.edu.pe', 'group' => 'contacto', 'label' => 'Correo de Contacto'],
            ['key' => 'contact_phone', 'value' => '(01) 614-7800 Anexos 212 / 215 / 218', 'value_en' => '+51 1 614-7800 Ext. 212 / 215 / 218', 'group' => 'contacto', 'label' => 'Teléfono y Anexos'],
            ['key' => 'contact_address', 'value' => 'Av. La Molina s/n, La Molina — Lima, Perú (Edificio del Rectorado, 2.° Piso)', 'value_en' => 'Av. La Molina s/n, La Molina — Lima, Peru (Rectorate Building, 2nd Floor)', 'group' => 'contacto', 'label' => 'Dirección Física'],
            ['key' => 'contact_hours', 'value' => 'Lunes a Viernes: 8:00 a.m. a 4:00 p.m.', 'value_en' => 'Monday to Friday: 8:00 a.m. to 4:00 p.m.', 'group' => 'contacto', 'label' => 'Horario de Atención'],
        ];

        foreach ($settingsData as $sd) {
            SiteSetting::updateOrCreate(['key' => $sd['key']], $sd);
        }
    }
}
