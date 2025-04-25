<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\AdminActivity;

class AdminActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view activity logs');
    }

    /**
     * Display a listing of activity logs.
     */
    public function index(Request $request)
    {
        $query = AdminActivity::with('user');
        
        // Filter by action
        if ($request->has('action')) {
            $query->action($request->input('action'));
        }
        
        // Filter by entity type
        if ($request->has('entity_type')) {
            $query->entityType($request->input('entity_type'));
        }
        
        // Filter by user
        if ($request->has('user_id')) {
            $query->user($request->input('user_id'));
        }
        
        // Filter by date range
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }
        
        $activities = $query->latest()->paginate(20);
        
        // Get unique values for filters
        $actions = AdminActivity::select('action')->distinct()->pluck('action');
        $entityTypes = AdminActivity::select('entity_type')->distinct()->pluck('entity_type');
        
        return view('admin::activities.index', compact('activities', 'actions', 'entityTypes'));
    }

    /**
     * Display the specified activity log details.
     */
    public function show($id)
    {
        $activity = AdminActivity::with('user')->findOrFail($id);
        
        return view('admin::activities.show', compact('activity'));
    }

    /**
     * Export activities as CSV.
     */
    public function export(Request $request)
    {
        $query = AdminActivity::with('user');
        
        // Apply filters
        if ($request->has('action')) {
            $query->action($request->input('action'));
        }
        
        if ($request->has('entity_type')) {
            $query->entityType($request->input('entity_type'));
        }
        
        if ($request->has('user_id')) {
            $query->user($request->input('user_id'));
        }
        
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }
        
        $activities = $query->latest()->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="activity-logs-' . date('Y-m-d') . '.csv"',
        ];
        
        $columns = ['ID', 'User', 'Action', 'Entity Type', 'Entity ID', 'Description', 'IP Address', 'User Agent', 'Date'];
        
        $callback = function() use ($activities, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($activities as $activity) {
                fputcsv($file, [
                    $activity->id,
                    $activity->user ? $activity->user->name : 'System',
                    $activity->action,
                    $activity->entity_type,
                    $activity->entity_id,
                    $activity->description,
                    $activity->ip_address,
                    $activity->user_agent,
                    $activity->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get recent activities for dashboard.
     */
    public function recent(Request $request)
    {
        $limit = $request->input('limit', 10);
        $activities = AdminActivity::with('user')->latest()->limit($limit)->get();
        
        return response()->json([
            'success' => true,
            'data' => $activities
        ]);
    }
} 