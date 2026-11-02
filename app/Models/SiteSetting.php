<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'value_en',
        'group',
        'label',
    ];

    public static array $englishDefaults = [
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

    public static function isTranslatableKey(string $key, ?string $value): bool
    {
        if (preg_match('/(path|url|file|media_type|photo|image|email|phone)/i', $key)) {
            return false;
        }

        if (empty($value) || is_numeric($value)) {
            return false;
        }

        if (str_starts_with($value, 'http') || str_starts_with($value, 'storage/') || str_starts_with($value, 'videos/') || str_starts_with($value, 'imagenes/')) {
            return false;
        }

        return true;
    }

    protected static function booted(): void
    {
        static::saving(function ($setting) {
            if (!empty($setting->value) && (empty($setting->value_en) || trim((string)$setting->value_en) === '')) {
                if (static::isTranslatableKey($setting->key, $setting->value)) {
                    try {
                        $setting->value_en = \App\Services\TranslationService::translate($setting->value, 'es', 'en');
                    } catch (\Throwable $e) {
                        // Keep saving
                    }
                }
            }
        });
    }

    public static function get(string $key, ?string $default = null, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale() ?: session('locale', 'es');
        $setting = static::where('key', $key)->first();

        if ($locale === 'en') {
            if ($setting && !empty(trim((string)$setting->value_en))) {
                return $setting->value_en;
            }

            if ($setting && !empty(trim((string)$setting->value)) && static::isTranslatableKey($key, $setting->value)) {
                $translated = \App\Services\TranslationService::translate($setting->value, 'es', 'en');
                if (!empty($translated)) {
                    try {
                        $setting->updateQuietly(['value_en' => $translated]);
                    } catch (\Throwable $e) {
                        // ignore
                    }
                    return $translated;
                }
            }

            if (isset(static::$englishDefaults[$key])) {
                return static::$englishDefaults[$key];
            }
        }

        if (!$setting) {
            return $default;
        }

        return $setting->value ?? $default;
    }

    public static function set(string $key, ?string $value, ?string $value_en = null, string $group = 'general', ?string $label = null): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'value_en' => $value_en,
                'group' => $group,
                'label' => $label,
            ]
        );
    }
}
