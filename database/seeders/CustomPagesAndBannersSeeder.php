<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BannerImage;
use App\Models\CustomPage;

class CustomPagesAndBannersSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Fotos oficiales de portada precargadas
        $banners = [
            [
                'title' => 'Becarios de Excelencia 2025',
                'title_en' => 'Academic Excellence Scholars 2025',
                'image_path' => 'imagenes/portadas/portada1.png',
                'is_active_carousel' => true,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Experiencias de Intercambio',
                'title_en' => 'Student Exchange Experiences',
                'image_path' => 'imagenes/portadas/portada2.png',
                'is_active_carousel' => true,
                'is_featured' => false,
                'order' => 2,
            ],
            [
                'title' => 'Campus y Vida Molinera',
                'title_en' => 'UNALM Campus & Molinero Life',
                'image_path' => 'imagenes/portadas/portada3.png',
                'is_active_carousel' => true,
                'is_featured' => false,
                'order' => 3,
            ],
        ];

        foreach ($banners as $b) {
            BannerImage::firstOrCreate(['image_path' => $b['image_path']], $b);
        }

        // 2. Páginas de Redes Internacionales y Nacionales
        $pages = [
            [
                'title' => 'IAAS — International Association of Students in Agricultural and Related Sciences',
                'title_en' => 'IAAS — International Association of Students in Agricultural and Related Sciences',
                'slug' => 'iaas-peru-unalm',
                'nav_section' => 'redes_internacionales',
                'summary' => 'Organización global que conecta a estudiantes de ciencias agrarias con comités en Europa, América y el mundo, con sede oficial en la UNALM.',
                'summary_en' => 'Global student association connecting agricultural sciences students across Europe, the Americas, and worldwide, officially based at UNALM.',
                'content' => '<p>La <strong>"International Association of Students in Agricultural and Related Sciences" (IAAS)</strong> es una organización que busca conectar a estudiantes de todo el mundo, quienes buscan compartir los mismos anhelos e ideas para la agricultura y ciencias relacionadas. Está conformada por varios comités en diferentes partes del mundo como España, Alemania, Estados Unidos, y también países sudamericanos como Chile, Colombia, Paraguay y Ecuador. <strong>IAAS – PERÚ</strong>.</p>'
                    . '<p>A través de la sede IAAS Madrid en España, la becaria de Excelencia Académica 2018, Claudia Ortega, tuvo la oportunidad de experimentar una semana de intercambio, financiada por IAAS Alemania, la cual consistió en visitar diferentes empresas agrícolas alemanas, visita a la sede de la ONU, entrenamientos de liderazgo y charlas relacionadas a problemáticas globales vinculadas a crear enlaces mundiales entre países desarrollados y en vías de desarrollo. Además, pudo conocer a varios colegas de diferentes países y continentes, teniendo al idioma inglés como el principal medio de comunicación.</p>'
                    . '<p>Considerando los grandes beneficios que conlleva ser parte del IAAS, cinco estudiantes molineras de las facultades de Agronomía y Ciencias decidieron instalar la sede de esta organización en nuestra casa de estudios contando con el respaldo del Rectorado y de la Oficina de Gestión Interinstitucional y Asuntos Globales (OGI / ORI).</p>'
                    . '<p>Actualmente se encuentran generando vínculos con las agrupaciones de investigación de las diferentes facultades que conforman la universidad; y se encuentran actualmente organizando charlas con instituciones nacionales e internacionales dentro del campus universitario. El objetivo de estas charlas es seguir expandiendo la agrupación en otras universidades del Perú, con carreras vinculadas al agro, teniendo como sede principal a la Universidad Nacional Agraria La Molina.</p>',
                'featured_image_path' => 'imagenes/redes/iaas_oficial.png',
                'show_in_nav' => true,
                'is_published' => true,
                'order' => 1,
            ],
            [
                'title' => 'IFSA — International Forestry Students Association',
                'title_en' => 'IFSA — International Forestry Students Association',
                'slug' => 'ifsa-unalm',
                'nav_section' => 'redes_internacionales',
                'summary' => 'Red estudiantil forestal mundial que conecta a futuros líderes en silvicultura y conservación ambiental, con comité activo en la UNALM.',
                'summary_en' => 'Worldwide forestry student network connecting future leaders in silviculture and environmental conservation, with an active committee at UNALM.',
                'content' => '<p><strong>IFSA (International Forestry Students Association)</strong> es una organización de estudiantes organizada globalmente y que opera localmente. Conectamos a los estudiantes de silvicultura con sus pares y con organizaciones relacionadas con los bosques y plataformas de políticas. Esencialmente en el negocio de conectar, capacitar y educar a la próxima generación de líderes forestales y ambientales.</p>'
                    . '<p>Su misión es proporcionar una plataforma para que los estudiantes de ciencias forestales enriquezcan su educación formal, promuevan la comprensión cultural al fomentar la colaboración con organizaciones asociadas internacionales y faciliten a los estudiantes obtener experiencias prácticas con una perspectiva más amplia y global. A través de su red, IFSA fomenta las reuniones de estudiantes, permite la participación en debates científicos y apoya la participación de los jóvenes en los procesos de toma de decisiones y en la política forestal y ambiental internacional.</p>'
                    . '<p>La Universidad Nacional Agraria La Molina cuenta con una organización activa de estudiantes de la <strong>Facultad de Ciencias Forestales</strong> pertenecientes a IFSA, representando al Perú en cumbres y foros globales de silvicultura y manejo sostenible de recursos naturales.</p>',
                'featured_image_path' => 'imagenes/portadas/portada3.png',
                'show_in_nav' => true,
                'is_published' => true,
                'order' => 2,
            ],
            [
                'title' => 'RUNAI — Red Universitaria Nacional de Asuntos Internacionales',
                'title_en' => 'RUNAI — National University Network for International Affairs',
                'slug' => 'runai-peru',
                'nav_section' => 'redes_nacionales',
                'summary' => 'Espacio de articulación interuniversitaria para la internacionalización y movilidad académica entre universidades del Perú.',
                'summary_en' => 'Inter-university coordination platform fostering internationalization and academic mobility across universities in Peru.',
                'content' => '<p>La <strong>Red Universitaria Nacional de Asuntos Internacionales (RUNAI)</strong> es un espacio de articulación y cooperación interuniversitaria que agrupa a las oficinas de relaciones internacionales y cooperación de las principales universidades públicas y privadas del Perú.</p>'
                    . '<p>Su objetivo fundamental es promover la internacionalización solidaria de la educación superior universitaria peruana, fortaleciendo las capacidades de gestión, fomentando la movilidad académica estudiantil y docente entre universidades del país, y generando sinergias para la participación conjunta en redes globales, convocatorias internacionales de investigación y proyectos de cooperación técnica multilateral.</p>'
                    . '<p>La Universidad Nacional Agraria La Molina (UNALM), a través de la Oficina de Gestión Interinstitucional y Asuntos Globales (OGI), participa activamente en los encuentros y comisiones técnicas de la RUNAI, contribuyendo al diseño de lineamientos de movilidad nacional y políticas de internacionalización con impacto social y regional.</p>',
                'featured_image_path' => 'imagenes/portadas/portada2.png',
                'show_in_nav' => true,
                'is_published' => true,
                'order' => 1,
            ],
        ];

        foreach ($pages as $p) {
            CustomPage::firstOrCreate(['slug' => $p['slug']], $p);
        }
    }
}

