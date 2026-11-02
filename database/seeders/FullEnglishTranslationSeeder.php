<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Partner;
use App\Models\Resource;
use App\Models\Call;
use App\Models\News;

class FullEnglishTranslationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SITE SETTINGS ENGLISHDATA
        $siteSettingsTranslations = [
            'hero_badge' => 'Internationalization & Global Cooperation',
            'hero_title' => 'Office of Inter-institutional Management and Global Affairs',
            'hero_subtitle' => 'Promoting internationalization, strategic partnerships, and academic mobility for the agricultural and scientific community in Peru and worldwide.',
            'stat_countries' => '19+',
            'stat_agreements' => '74+',
            'stat_faculties' => '12',
            'stat_allies' => '6+',
            'contact_email' => 'ogi@lamolina.edu.pe',
            'contact_phone' => '+51 1 614-7800 Ext. 212 / 215 / 218',
            'contact_address' => "Av. La Molina s/n, La Molina — Lima, Peru\nUNALM University Campus (Rectorate Building, 2nd Floor)",
            'contact_hours' => 'Monday to Friday: 8:00 a.m. to 4:00 p.m.',
            'presentation_badge' => 'Our Office',
            'presentation_title' => 'Institutional Presentation',
            'presentation_director_name' => 'Dra. Fabiola Otilia Olivares Ponce',
            'presentation_director_role' => 'Director of the Office of Inter-institutional Management and Global Affairs',
            'presentation_message_title' => "Director's Message",
            'presentation_message_p1' => 'The Office of Inter-institutional Management and Global Affairs (OGI) of the Universidad Nacional Agraria La Molina is the university governing body responsible for guiding, promoting, managing, and overseeing academic, scientific, cultural, and technical cooperation relationships between our university and prestigious national and international institutions.',
            'presentation_message_p2' => 'In today’s versatile and challenging global landscape, our mission is to build effective bridges that enable our students, faculty, and researchers to actively participate in global mobility programs, scientific networks of excellence, and transnational research projects that contribute to sustainable development, food security, and environmental conservation in Peru and the planet.',
            'presentation_message_p3' => 'We place this renewed portal at the service of the university community and our global partners, designed according to high standards of accessibility, transparency, and direct communication to connect Molinero knowledge with world-class opportunities.',
            'presentation_fn1_title' => 'Strategic Advisory & Linkages',
            'presentation_fn1_desc' => 'Advise the Rectorate and Faculty Councils on the formulation, negotiation, execution, and monitoring of national and international inter-institutional agreements.',
            'presentation_fn2_title' => 'Academic Mobility Management',
            'presentation_fn2_desc' => 'Manage national and international student and faculty mobility calls, offering continuous guidance to outgoing students and visiting international scholars.',
            'presentation_fn3_title' => 'Scholarship Opportunities & Demand',
            'presentation_fn3_desc' => 'Connect national and international study and research scholarship opportunities with the academic and research aspirations of the UNALM community (BEAI, Santander, Pacific Alliance, Fulbright, etc.).',
            'presentation_fn4_title' => 'Global Networks & Alliances',
            'presentation_fn4_desc' => 'Strengthen UNALM’s presence in inter-university consortiums, thematic scientific networks, and multilateral cooperation forums with international agencies.',
            'mv_badge' => 'Strategic Framework',
            'mv_title' => 'Mission, Vision & Values',
            'mv_vision_title' => 'Institutional Vision',
            'mv_vision_text' => 'Strategically position UNALM within the versatile international context and serve as the leading managerial hub for the pillars of university internationalization: mobility and cooperation in education, interculturality, research, and outreach across agricultural, livestock, fisheries, production, economic, food, environmental sustainability, and innovation fields.',
            'mv_mission_title' => 'Institutional Mission',
            'mv_mission_text' => 'Increase the number of high-impact national and international partnerships leading to multidisciplinary international cooperation programs, collaborating actively with UNALM faculty, students, and alumni in the necessary procedures for their successful integration into global initiatives.',
            'mv_values_title' => 'Our Molinero Values',
            'mv_val1_title' => 'Commitment',
            'mv_val1_desc' => 'Dedication to academic excellence and institutional advancement.',
            'mv_val2_title' => 'Identity',
            'mv_val2_desc' => 'Pride in our agricultural, scientific, and environmental heritage.',
            'mv_val3_title' => 'Responsibility',
            'mv_val3_desc' => 'Transparency, technical rigor, and regulatory compliance in every partnership.',
            'mv_val4_title' => 'Communication',
            'mv_val4_desc' => 'Constructive, timely dialogue with students, faculty, and global allies.',
            'resources_badge' => 'Document Repository',
            'resources_title' => 'Resources, Guidelines & Regulations',
            'resources_subtitle' => 'Direct download of exchange guidelines, institutional policies, Molinero newsletters, and official consolidated agreement directories.',
            'team_badge' => 'Institutional Directory',
            'team_title' => 'OGI Management Team',
            'team_subtitle' => 'Dedicated professionals committed to guiding and assisting the university community in mobility, scholarships, and international agreements.',
            'contact_badge' => 'Service Channels',
            'contact_title' => 'Institutional Contact',
            'contact_subtitle' => 'Get in touch with our directorship and program coordinators for inquiries regarding agreements, academic mobility, and scholarship opportunities.',
            'contact_proposal_title' => 'For International Partners & Institutions',
            'contact_proposal_desc' => 'If you represent a university, research organization, or international agency and wish to initiate the process to establish a new Framework Agreement or Specific Mobility Agreement with UNALM:',
            'contact_step1' => 'Submit a formal letter of intent signed by the authorized authority of your institution.',
            'contact_step2' => 'Attach the draft agreement proposal specifying faculties, disciplines, or areas of mutual interest.',
            'contact_step3' => 'Email the digital documentation to our official institutional inbox: ogi@lamolina.edu.pe.',
        ];

        foreach ($siteSettingsTranslations as $key => $valEn) {
            SiteSetting::where('key', $key)->update(['value_en' => $valEn]);
        }

        // 2. TEAM MEMBERS TRANSLATIONS
        $teamTranslations = [
            5 => [
                'role_title_en' => 'Director of the Office of Inter-institutional Management and Global Affairs',
                'bio_en' => 'Oversees the university internationalization strategy, strategic global alliances, mobility programs, and transnational scientific cooperation for UNALM.',
            ],
            2 => [
                'role_title_en' => 'Academic Mobility and Scholarships Coordinator',
                'bio_en' => 'Specialist in comprehensive exchange scholarship advising, application management for incoming and outgoing students, and multilateral agreements.',
            ],
            3 => [
                'role_title_en' => 'Agreements and Inter-institutional Networks Specialist',
                'bio_en' => 'Technical-legal management and monitoring of framework and specific national and international agreements at UNALM.',
            ],
            4 => [
                'role_title_en' => 'Cooperation and Project Management Assistant',
                'bio_en' => 'Support for international calls, monitoring diplomatic missions, and relations with cooperation agencies.',
            ],
        ];

        foreach ($teamTranslations as $id => $data) {
            TeamMember::where('id', $id)->update($data);
        }

        // 3. PARTNERS TRANSLATIONS
        $partnerTranslations = [
            1 => 'Governing body for international technical cooperation in Peru.',
            2 => 'Promoting educational and scientific exchange between Peru and the United States.',
            3 => 'Supporting socio-economic and environmental development through Japanese cooperation.',
            4 => 'Government agency of the Republic of Korea for development programs and technical scholarships.',
            5 => 'National Scholarship and Educational Credit Program of the Ministry of Education of Peru.',
            6 => 'Educational, scientific partnerships and joint cultural development programs.',
        ];

        foreach ($partnerTranslations as $id => $descEn) {
            Partner::where('id', $id)->update(['description_en' => $descEn]);
        }

        // 4. RESOURCES TRANSLATIONS
        $resourceTranslations = [
            1 => [
                'title_en' => 'International Exchange Student Handbook — UNALM',
                'description_en' => 'Complete guide with welcome information, student visa procedures, health insurance, campus services, housing, and student life in Lima.',
            ],
            2 => [
                'title_en' => 'Official Consolidated Directory of Active International Agreements',
                'description_en' => 'Formal directory of institutions, countries, and validity of international agreements signed by UNALM.',
            ],
            3 => [
                'title_en' => 'Official Consolidated Directory of Active National Agreements',
                'description_en' => 'Catalog of cooperation agreements with Peruvian universities, ministries, regional governments, and companies.',
            ],
            4 => [
                'title_en' => 'BEAI Guidelines and Awardees List — International Academic Excellence',
                'description_en' => 'Directive and selection results for international mobility scholarships awarded by academic merit.',
            ],
            5 => [
                'title_en' => 'Molinero International Cooperation Bulletin — Special Edition',
                'description_en' => 'Informative publication featuring student testimonials, flagship agreements, and transnational research projects.',
            ],
        ];

        foreach ($resourceTranslations as $id => $data) {
            Resource::where('id', $id)->update($data);
        }

        // 5. CALLS TRANSLATIONS
        $callTranslations = [
            1 => [
                'description_en' => '<p>The Pacific Alliance Student and Academic Mobility Platform offers undergraduate students the opportunity to spend a fully accredited semester at renowned universities in Chile, Colombia, or Mexico.</p><p>Selected students receive monthly living stipends, international health insurance, round-trip airfare, and full tuition waivers at the partner institution.</p>',
            ],
            2 => [
                'description_en' => '<p>Santander Universities mobility grant program intended to facilitate undergraduate student exchanges at affiliated universities across Ibero-America, enhancing academic profiles and cross-cultural competencies.</p>',
            ],
            3 => [
                'description_en' => '<p>Institutional grant financed by UNALM aimed at recognizing and encouraging the highest academic GPAs of each faculty, funding travel and living stipends for a semester of exchange abroad.</p>',
            ],
            4 => [
                'description_en' => '<p>Prestigious international scholarships administered by the Fulbright Commission in Peru, offering funding and admissions placement for graduate study and doctoral research visits at leading universities in the United States.</p>',
            ],
            5 => [
                'description_en' => '<p>Specialized human resource training programs through technical courses and master’s scholarships in Japan, focused on watershed conservation, agricultural development, and natural disaster management.</p>',
            ],
        ];

        foreach ($callTranslations as $id => $data) {
            Call::where('id', $id)->update($data);
        }

        // 6. NEWS TRANSLATIONS
        $newsTranslations = [
            1 => [
                'content_en' => '<p>The Universidad Nacional Agraria La Molina, through its Office of Inter-institutional Management and Global Affairs (OGI), has signed a momentous Framework Cooperation Agreement with the District Municipality of Mazamari (Satipo, Junín).</p><p>The central goal of the agreement is the joint development of research and technology transfer initiatives in coffee, cacao, citrus, and native agroforestry resources, promoting local farmer training and internship placements for Molinero students.</p>',
            ],
            2 => [
                'content_en' => '<p>Within the framework of university-industry collaboration policies, authorities from UNALM and senior executives from Leche Gloria S.A. signed a technical-scientific agreement to promote applied research projects in ruminant nutrition, cattle genetics, and sustainable pasture management.</p><p>The partnership provides specialized internships at production facilities for students in Animal Science and Food Industries.</p>',
            ],
            3 => [
                'content_en' => '<p>With the objective of designing joint strategies for high-Andean environmental protection and food security, UNALM formalized a cooperation agreement with the Tres Cuencas Commonwealth, encompassing communities in the Santa, Fortaleza, and Pativilca basins.</p><p>The agreement focuses on watershed management, soil conservation, and organic potato production.</p>',
            ],
            4 => [
                'content_en' => '<p>UNALM authorities and the Mayor of Kimbiri signed a specific agreement aimed at improving cocoa and tropical fruit value chains in the VRAEM valley, providing technical assistance, agricultural extension, and research opportunities for UNALM graduates.</p>',
            ],
            5 => [
                'content_en' => '<p>A prominent delegation from the Polytechnic University of Madrid (UPM), led by international cooperation officials, visited the UNALM campus in Lima to strengthen bilateral academic ties.</p><p>During high-level working sessions with the OGI and Faculty Deans, both institutions agreed on expanding slots for faculty mobility, co-tutelle doctoral dissertations, and joint research projects under European funding programs.</p>',
            ],
        ];

        foreach ($newsTranslations as $id => $data) {
            News::where('id', $id)->update($data);
        }
    }
}

