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
    
    /**
     * Get resume service duration settings
     *
     * @return JsonResponse
     */
    public function getResumeDurationSettings(): JsonResponse
    {
        $settings = Cache::get('settings_resume_duration', []);
        
        return response()->json([
            'status' => 'success',
            'data' => $settings
        ]);
    }
    
    /**
     * Update resume service duration settings
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateResumeDurationSettings(Request $request): JsonResponse
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.default_duration' => 'required|integer|min:1',
            'settings.max_duration' => 'required|integer|gte:settings.default_duration',
            'settings.min_duration' => 'required|integer|min:1|lte:settings.default_duration'
        ]);
        
        $settings = $request->settings;
        
        // Store settings in cache
        Cache::put('settings_resume_duration', $settings, now()->addYear());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Resume service duration settings updated successfully',
            'data' => $settings
        ]);
    }
    
    /**
     * Get resume pricing settings
     *
     * @return JsonResponse
     */
    public function getResumePricingSettings(): JsonResponse
    {
        $settings = Cache::get('settings_resume_pricing', []);
        
        return response()->json([
            'status' => 'success',
            'data' => $settings
        ]);
    }
    
    /**
     * Update resume pricing settings
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateResumePricingSettings(Request $request): JsonResponse
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.base_price' => 'required|numeric|min:0',
            'settings.price_per_additional_hour' => 'required|numeric|min:0',
            'settings.discount_percentage' => 'nullable|numeric|min:0|max:100'
        ]);
        
        $settings = $request->settings;
        
        // Store settings in cache
        Cache::put('settings_resume_pricing', $settings, now()->addYear());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Resume pricing settings updated successfully',
            'data' => $settings
        ]);
    }
    
    /**
     * Get resume notification settings
     *
     * @return JsonResponse
     */
    public function getResumeNotificationSettings(): JsonResponse
    {
        $settings = Cache::get('settings_resume_notification', []);
        
        return response()->json([
            'status' => 'success',
            'data' => $settings
        ]);
    }
    
    /**
     * Update resume notification settings
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateResumeNotificationSettings(Request $request): JsonResponse
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.email_notifications' => 'required|boolean',
            'settings.sms_notifications' => 'required|boolean',
            'settings.notification_schedule' => 'nullable|array'
        ]);
        
        $settings = $request->settings;
        
        // Store settings in cache
        Cache::put('settings_resume_notification', $settings, now()->addYear());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Resume notification settings updated successfully',
            'data' => $settings
        ]);
    }
} 