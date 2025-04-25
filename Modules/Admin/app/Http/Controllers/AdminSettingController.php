<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\AdminSetting;
use Modules\Admin\Models\AdminActivity;

class AdminSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage settings');
    }

    /**
     * Display a listing of the settings.
     */
    public function index(Request $request)
    {
        $group = $request->input('group', 'general');
        $settings = AdminSetting::group($group)->get();
        $groups = AdminSetting::select('group')->distinct()->pluck('group');
        
        return view('admin::settings.index', compact('settings', 'groups', 'group'));
    }

    /**
     * Show the form for creating a new setting.
     */
    public function create()
    {
        $groups = AdminSetting::select('group')->distinct()->pluck('group');
        return view('admin::settings.create', compact('groups'));
    }

    /**
     * Store a newly created setting in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:255|unique:admin_settings,key',
            'value' => 'nullable',
            'group' => 'required|string|max:255',
            'is_public' => 'boolean',
            'data_type' => 'required|in:string,integer,boolean,float,array,object',
            'description' => 'nullable|string',
        ]);
        
        $setting = AdminSetting::create($data);
        
        // Log activity
        AdminActivity::logCreate('setting', $setting->id, $setting->toArray());
        
        return redirect()->route('admin.settings.index', ['group' => $setting->group])
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Show the form for editing the specified setting.
     */
    public function edit($id)
    {
        $setting = AdminSetting::findOrFail($id);
        $groups = AdminSetting::select('group')->distinct()->pluck('group');
        
        return view('admin::settings.edit', compact('setting', 'groups'));
    }

    /**
     * Update the specified setting in storage.
     */
    public function update(Request $request, $id)
    {
        $setting = AdminSetting::findOrFail($id);
        
        $data = $request->validate([
            'value' => 'nullable',
            'group' => 'required|string|max:255',
            'is_public' => 'boolean',
            'description' => 'nullable|string',
        ]);
        
        $beforeData = $setting->toArray();
        $setting->update($data);
        
        // Log activity
        AdminActivity::logUpdate('setting', $setting->id, $beforeData, $setting->toArray());
        
        return redirect()->route('admin.settings.index', ['group' => $setting->group])
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified setting from storage.
     */
    public function destroy($id)
    {
        $setting = AdminSetting::findOrFail($id);
        $group = $setting->group;
        
        // Log activity before deleting
        AdminActivity::logDelete('setting', $setting->id, $setting->toArray());
        
        $setting->delete();
        
        return redirect()->route('admin.settings.index', ['group' => $group])
            ->with('success', 'Setting deleted successfully.');
    }

    /**
     * Update multiple settings at once.
     */
    public function updateMultiple(Request $request)
    {
        $settings = $request->input('settings', []);
        
        foreach ($settings as $key => $value) {
            $setting = AdminSetting::where('key', $key)->first();
            
            if ($setting) {
                $beforeData = $setting->toArray();
                
                $setting->value = $value;
                $setting->save();
                
                // Log activity
                AdminActivity::logUpdate('setting', $setting->id, $beforeData, $setting->toArray());
            }
        }
        
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Get public settings as JSON
     */
    public function publicSettings()
    {
        $settings = AdminSetting::public()->get();
        $formattedSettings = [];
        
        foreach ($settings as $setting) {
            $formattedSettings[$setting->key] = $setting->value;
        }
        
        return response()->json([
            'success' => true,
            'data' => $formattedSettings
        ]);
    }
} 