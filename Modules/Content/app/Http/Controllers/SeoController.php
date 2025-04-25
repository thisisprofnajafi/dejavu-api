<?php

namespace Modules\Content\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Content\app\Http\Requests\StoreSeoRequest;
use Modules\Content\app\Http\Requests\UpdateSeoRequest;
use Modules\Content\app\Models\Seo;

class SeoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Content\app\Http\Requests\StoreSeoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeoRequest $request)
    {
        $data = $request->validated();
        
        // Handle image uploads
        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('public/seo/og');
        }
        
        if ($request->hasFile('twitter_image')) {
            $data['twitter_image'] = $request->file('twitter_image')->store('public/seo/twitter');
        }
        
        // Check if a SEO record already exists for this model
        $existing = Seo::where('seoable_type', $data['seoable_type'])
            ->where('seoable_id', $data['seoable_id'])
            ->first();
            
        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'SEO settings already exist for this resource. Please use update method instead.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $seo = Seo::create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'SEO settings created successfully',
            'data' => $seo
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $type, int $id)
    {
        $seo = Seo::where('seoable_type', $type)
            ->where('seoable_id', $id)
            ->first();
            
        if (!$seo) {
            return response()->json([
                'success' => false,
                'message' => 'SEO settings not found for this resource'
            ], Response::HTTP_NOT_FOUND);
        }
        
        return response()->json([
            'success' => true,
            'data' => $seo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Content\app\Http\Requests\UpdateSeoRequest  $request
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeoRequest $request, string $type, int $id)
    {
        $seo = Seo::where('seoable_type', $type)
            ->where('seoable_id', $id)
            ->first();
            
        if (!$seo) {
            return response()->json([
                'success' => false,
                'message' => 'SEO settings not found for this resource'
            ], Response::HTTP_NOT_FOUND);
        }
        
        $data = $request->validated();
        
        // Handle image uploads
        if ($request->hasFile('og_image')) {
            // Delete old image if exists
            if ($seo->og_image) {
                Storage::delete($seo->og_image);
            }
            
            $data['og_image'] = $request->file('og_image')->store('public/seo/og');
        }
        
        if ($request->hasFile('twitter_image')) {
            // Delete old image if exists
            if ($seo->twitter_image) {
                Storage::delete($seo->twitter_image);
            }
            
            $data['twitter_image'] = $request->file('twitter_image')->store('public/seo/twitter');
        }
        
        $seo->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'SEO settings updated successfully',
            'data' => $seo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $type, int $id)
    {
        $seo = Seo::where('seoable_type', $type)
            ->where('seoable_id', $id)
            ->first();
            
        if (!$seo) {
            return response()->json([
                'success' => false,
                'message' => 'SEO settings not found for this resource'
            ], Response::HTTP_NOT_FOUND);
        }
        
        // Delete images if they exist
        if ($seo->og_image) {
            Storage::delete($seo->og_image);
        }
        
        if ($seo->twitter_image) {
            Storage::delete($seo->twitter_image);
        }
        
        $seo->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'SEO settings deleted successfully'
        ]);
    }
} 