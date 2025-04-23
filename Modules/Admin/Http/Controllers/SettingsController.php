<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Available setting types
     */
    protected $settingTypes = [
        'service_duration',
        'pricing',
        'notifications'
    ];

    /**
     * Get all settings
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $settings = [];
        
        foreach ($this->settingTypes as $type) {
            $settings[$type] = Cache::get('settings_' . $type, []);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $settings
        ]);
    }
    
    /**
     * Get specific setting type
     *
     * @param string $type
     * @return JsonResponse
     */
    public function getSettingsByType(string $type): JsonResponse
    {
        if (!in_array($type, $this->settingTypes)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid setting type'
            ], 400);
        }
        
        $settings = Cache::get('settings_' . $type, []);
        
        return response()->json([
            'status' => 'success',
            'data' => $settings
        ]);
    }
    
    /**
     * Update settings by type
     *
     * @param Request $request
     * @param string $type
     * @return JsonResponse
     */
    public function updateSettings(Request $request, string $type): JsonResponse
    {
        if (!in_array($type, $this->settingTypes)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid setting type'
            ], 400);
        }
        
        $request->validate([
            'settings' => 'required|array'
        ]);
        
        $settings = $request->settings;
        
        // Store settings in cache
        Cache::put('settings_' . $type, $settings, now()->addYear());
        
        return response()->json([
            'status' => 'success',
            'message' => ucfirst($type) . ' settings updated successfully',
            'data' => $settings
        ]);
    }
} 