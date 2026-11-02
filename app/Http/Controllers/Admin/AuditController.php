<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user');

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where('details', 'like', $term)
                  ->orWhere('user_name', 'like', $term)
                  ->orWhere('ip_address', 'like', $term);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.audit.index', compact('logs'));
    }
}
