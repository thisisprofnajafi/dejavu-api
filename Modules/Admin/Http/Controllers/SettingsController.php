<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Settings', description: 'API endpoints for system settings management')]
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
    #[OA\Get(
        path: '/api/v1/admin/settings',
        summary: 'Get all settings',
        description: 'Retrieves all system settings',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings retrieved successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object', properties: [
                    new OA\Property(property: 'service_duration', type: 'object'),
                    new OA\Property(property: 'pricing', type: 'object'),
                    new OA\Property(property: 'notifications', type: 'object')
                ])
            ]
        )
    )]
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
    #[OA\Get(
        path: '/api/v1/admin/settings/{type}',
        summary: 'Get settings by type',
        description: 'Retrieves settings for a specific type',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'type',
        in: 'path',
        required: true,
        description: 'Setting type',
        schema: new OA\Schema(type: 'string', enum: ['service_duration', 'pricing', 'notifications'])
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings retrieved successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: 'Invalid setting type',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'message', type: 'string', example: 'Invalid setting type')
            ]
        )
    )]
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
    #[OA\Put(
        path: '/api/v1/admin/settings/{type}',
        summary: 'Update settings by type',
        description: 'Updates settings for a specific type',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'type',
        in: 'path',
        required: true,
        description: 'Setting type',
        schema: new OA\Schema(type: 'string', enum: ['service_duration', 'pricing', 'notifications'])
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'settings', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Settings updated successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: 'Invalid setting type',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'message', type: 'string', example: 'Invalid setting type')
            ]
        )
    )]
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
    #[OA\Get(
        path: '/api/v1/admin/settings/resume/duration',
        summary: 'Get resume duration settings',
        description: 'Retrieves service duration settings for resumes',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings retrieved successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object', properties: [
                    new OA\Property(property: 'default_duration', type: 'integer', example: 5),
                    new OA\Property(property: 'max_duration', type: 'integer', example: 10),
                    new OA\Property(property: 'min_duration', type: 'integer', example: 1)
                ])
            ]
        )
    )]
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
    #[OA\Put(
        path: '/api/v1/admin/settings/resume/duration',
        summary: 'Update resume duration settings',
        description: 'Updates service duration settings for resumes',
        security: [['bearerAuth' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'settings', type: 'object', properties: [
                    new OA\Property(property: 'default_duration', type: 'integer', example: 5),
                    new OA\Property(property: 'max_duration', type: 'integer', example: 10),
                    new OA\Property(property: 'min_duration', type: 'integer', example: 1)
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Resume service duration settings updated successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
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
    #[OA\Get(
        path: '/api/v1/admin/settings/resume/pricing',
        summary: 'Get resume pricing settings',
        description: 'Retrieves pricing settings for resumes',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings retrieved successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object', properties: [
                    new OA\Property(property: 'base_price', type: 'number', format: 'float', example: 99.99),
                    new OA\Property(property: 'price_per_additional_hour', type: 'number', format: 'float', example: 19.99),
                    new OA\Property(property: 'discount_percentage', type: 'number', format: 'float', example: 10.0)
                ])
            ]
        )
    )]
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
    #[OA\Put(
        path: '/api/v1/admin/settings/resume/pricing',
        summary: 'Update resume pricing settings',
        description: 'Updates pricing settings for resumes',
        security: [['bearerAuth' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'settings', type: 'object', properties: [
                    new OA\Property(property: 'base_price', type: 'number', format: 'float', example: 99.99),
                    new OA\Property(property: 'price_per_additional_hour', type: 'number', format: 'float', example: 19.99),
                    new OA\Property(property: 'discount_percentage', type: 'number', format: 'float', example: 10.0)
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Resume pricing settings updated successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
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
    #[OA\Get(
        path: '/api/v1/admin/settings/resume/notification',
        summary: 'Get resume notification settings',
        description: 'Retrieves notification settings for resumes',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings retrieved successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object', properties: [
                    new OA\Property(property: 'email_notifications', type: 'boolean', example: true),
                    new OA\Property(property: 'sms_notifications', type: 'boolean', example: false),
                    new OA\Property(property: 'notification_schedule', type: 'array', items: new OA\Items(type: 'object'))
                ])
            ]
        )
    )]
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
    #[OA\Put(
        path: '/api/v1/admin/settings/resume/notification',
        summary: 'Update resume notification settings',
        description: 'Updates notification settings for resumes',
        security: [['bearerAuth' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'settings', type: 'object', properties: [
                    new OA\Property(property: 'email_notifications', type: 'boolean', example: true),
                    new OA\Property(property: 'sms_notifications', type: 'boolean', example: false),
                    new OA\Property(property: 'notification_schedule', type: 'array', items: new OA\Items(type: 'object'))
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Settings updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Resume notification settings updated successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
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