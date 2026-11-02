<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreement;
use App\Models\Call;
use App\Models\News;
use App\Models\Resource;
use App\Models\User;
use App\Models\AuditLog;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_agreements' => Agreement::count(),
            'active_agreements' => Agreement::where('status', 'vigente')->count(),
            'expiring_agreements' => Agreement::where('status', 'por_vencer')->count(),
            'open_calls' => Call::open()->count(),
            'total_news' => News::count(),
            'total_resources' => Resource::count(),
            'total_users' => User::count(),
        ];

        $recentAgreements = Agreement::with(['institution.country', 'type'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentCalls = Call::orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $recentLogs = AuditLog::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAgreements', 'recentCalls', 'recentLogs'));
    }

    /**
     * Endpoint AJAX para auto-traducción interactiva de campos desde la intranet
     */
    public function autoTranslate(Request $request)
    {
        $request->validate([
            'fields' => 'required|array',
            'from' => 'nullable|string|size:2',
            'to' => 'nullable|string|size:2',
        ]);

        $from = $request->input('from', 'es');
        $to = $request->input('to', 'en');
        $fields = $request->input('fields');
        $translations = [];

        foreach ($fields as $key => $text) {
            if (!empty($text) && is_string($text)) {
                $translations[$key] = \App\Services\TranslationService::translate($text, $from, $to);
            } else {
                $translations[$key] = '';
            }
        }

        return response()->json([
            'success' => true,
            'translations' => $translations,
        ]);
    }
}
