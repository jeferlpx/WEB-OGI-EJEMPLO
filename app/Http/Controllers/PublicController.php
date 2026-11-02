<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreement;
use App\Models\Call;
use App\Models\News;
use App\Models\Resource;
use App\Models\TeamMember;
use App\Models\Partner;
use App\Models\Country;
use App\Models\AgreementType;
use App\Models\Faq;
use App\Models\SiteSetting;

class PublicController extends Controller
{
    public function home()
    {
        $featuredCalls = Call::published()
            ->open()
            ->orderBy('deadline_date')
            ->take(3)
            ->get();

        $recentNews = News::published()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $partners = Partner::active()->get();
        $faqs = Faq::published()->take(4)->get();

        $stats = [
            'countries' => SiteSetting::get('stat_countries', '19+'),
            'agreements' => Agreement::published()->count(),
            'calls' => Call::published()->open()->count(),
            'faculties' => SiteSetting::get('stat_faculties', '12'),
        ];

        return view('pages.home', compact('featuredCalls', 'recentNews', 'partners', 'faqs', 'stats'));
    }

    public function presentation()
    {
        $director = TeamMember::where('role_title', 'like', '%Director%')->first();
        return view('pages.presentation', compact('director'));
    }

    public function missionVision()
    {
        return view('pages.mission_vision');
    }

    public function team()
    {
        $team = TeamMember::active()->get();
        return view('pages.team', compact('team'));
    }

    public function internationalAgreements(Request $request)
    {
        $query = Agreement::published()->international()->with(['institution.country', 'type']);

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                  ->orWhereHas('institution', function ($qi) use ($term) {
                      $qi->where('name', 'like', $term);
                  });
            });
        }

        if ($request->filled('country')) {
            $query->whereHas('institution.country', function ($q) use ($request) {
                $q->where('name', $request->country);
            });
        }

        if ($request->filled('type')) {
            $query->where('agreement_type_id', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $agreements = $query->orderBy('title')->get();

        $countries = Country::whereHas('institutions.agreements', function ($q) {
            $q->where('scope', 'internacional')->where('publication_status', 'publicado');
        })->orderBy('name')->get();

        $types = AgreementType::orderBy('name')->get();

        return view('pages.agreements_international', compact('agreements', 'countries', 'types'));
    }

    public function nationalAgreements(Request $request)
    {
        $query = Agreement::published()->national()->with(['institution.country', 'type']);

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                  ->orWhereHas('institution', function ($qi) use ($term) {
                      $qi->where('name', 'like', $term);
                  });
            });
        }

        if ($request->filled('type')) {
            $query->where('agreement_type_id', $request->type);
        }

        $agreements = $query->orderBy('title')->get();
        $types = AgreementType::orderBy('name')->get();

        return view('pages.agreements_national', compact('agreements', 'types'));
    }

    public function networks()
    {
        $internationalPartners = Partner::where('category', 'red_internacional')
            ->orWhere('category', 'agencia_cooperacion')
            ->active()
            ->get();

        $nationalPartners = Partner::where('category', 'red_nacional')
            ->active()
            ->get();

        return view('pages.networks', compact('internationalPartners', 'nationalPartners'));
    }

    public function outgoingMobility()
    {
        $beaiCalls = Call::published()
            ->where(function ($q) {
                $q->where('slug', 'like', '%beai%')
                  ->orWhere('slug', 'like', '%excelencia%');
            })
            ->get();

        $faqs = Faq::where('category', 'movilidad_saliente')->published()->get();
        $guide = Resource::where('file_path', 'like', '%Guia%')->first();
        $customModules = \App\Models\CustomPage::where('nav_section', 'movilidad_saliente')->published()->ordered()->get();

        return view('pages.mobility_outgoing', compact('beaiCalls', 'faqs', 'guide', 'customModules'));
    }

    public function academicExcellence()
    {
        $beaiCalls = Call::published()
            ->where(function ($q) {
                $q->where('slug', 'like', '%beai%')
                  ->orWhere('slug', 'like', '%excelencia%');
            })
            ->get();

        $customModules = \App\Models\CustomPage::where('nav_section', 'movilidad_saliente')->published()->ordered()->get();

        return view('pages.mobility_excellence', compact('beaiCalls', 'customModules'));
    }

    public function pacificAlliance()
    {
        $allianceCalls = Call::published()
            ->where(function ($q) {
                $q->where('slug', 'like', '%alianza%')
                  ->orWhere('slug', 'like', '%pacifico%');
            })
            ->get();

        $customModules = \App\Models\CustomPage::where('nav_section', 'movilidad_saliente')->published()->ordered()->get();

        return view('pages.mobility_pacific_alliance', compact('allianceCalls', 'customModules'));
    }

    public function incomingMobility()
    {
        $faqs = Faq::where('category', 'movilidad_entrante')->published()->get();
        $guide = Resource::where('file_path', 'like', '%Guia%')->first();
        $customModules = \App\Models\CustomPage::where('nav_section', 'movilidad_entrante')->published()->ordered()->get();

        return view('pages.mobility_incoming', compact('faqs', 'guide', 'customModules'));
    }

    public function specialPrograms()
    {
        $customModules = \App\Models\CustomPage::where('nav_section', 'movilidad_entrante')->published()->ordered()->get();
        return view('pages.mobility_special_programs', compact('customModules'));
    }

    public function foreignTestimonies()
    {
        $customModules = \App\Models\CustomPage::where('nav_section', 'movilidad_entrante')->published()->ordered()->get();
        return view('pages.mobility_testimonies', compact('customModules'));
    }

    public function delegationVisits()
    {
        $customModules = \App\Models\CustomPage::where('nav_section', 'movilidad_entrante')->published()->ordered()->get();
        return view('pages.mobility_delegations', compact('customModules'));
    }

    public function summerCamp()
    {
        $customModules = \App\Models\CustomPage::where('nav_section', 'summer_camp')->published()->ordered()->get();
        return view('pages.mobility_summer_camp', compact('customModules'));
    }

    public function callsIndex(Request $request)
    {
        $query = Call::published();

        if ($request->filled('type')) {
            $query->where('call_type', $request->type);
        }

        if ($request->filled('audience')) {
            $query->where(function ($q) use ($request) {
                $q->where('target_audience', $request->audience)
                  ->orWhere('target_audience', 'todos');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $calls = $query->orderBy('deadline_date')->paginate(9);

        return view('pages.calls_index', compact('calls'));
    }

    public function callShow(string $slug)
    {
        $call = Call::where('slug', $slug)->published()->firstOrFail();
        $relatedCalls = Call::published()
            ->where('id', '!=', $call->id)
            ->where('call_type', $call->call_type)
            ->take(3)
            ->get();

        return view('pages.call_show', compact('call', 'relatedCalls'));
    }

    public function newsIndex(Request $request)
    {
        $query = News::published();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $news = $query->orderBy('published_at', 'desc')->paginate(6);

        return view('pages.news_index', compact('news'));
    }

    public function newsShow(string $slug)
    {
        $article = News::where('slug', $slug)->published()->firstOrFail();
        $recent = News::published()->where('id', '!=', $article->id)->take(3)->get();

        return view('pages.news_show', compact('article', 'recent'));
    }

    public function resourcesIndex(Request $request)
    {
        $query = Resource::published();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $resources = $query->orderBy('created_at', 'desc')->get();

        return view('pages.resources_index', compact('resources'));
    }

    public function contact()
    {
        $faqs = Faq::published()->take(4)->get();
        return view('pages.contact', compact('faqs'));
    }

    public function customPage(string $slug)
    {
        $page = \App\Models\CustomPage::where('slug', $slug)->published()->firstOrFail();

        // Otras páginas de la misma sección para navegación lateral
        $relatedPages = \App\Models\CustomPage::where('nav_section', $page->nav_section)
            ->where('id', '!=', $page->id)
            ->published()
            ->ordered()
            ->take(6)
            ->get();

        return view('pages.custom_page', compact('page', 'relatedPages'));
    }

    public function setLocale(string $locale)
    {
        if (in_array($locale, ['es', 'en'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }
        return redirect()->back(fallback: route('home'));
    }
}
