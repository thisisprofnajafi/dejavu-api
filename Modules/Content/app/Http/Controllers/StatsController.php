<?php

namespace Modules\Content\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Content\app\Services\ContentService;

class StatsController extends Controller
{
    protected $contentService;
    
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
        $this->middleware('auth:sanctum')->except(['incrementViews']);
        $this->middleware('can:view content stats')->only(['postStats', 'categoryStats', 'tagStats', 'allStats']);
    }
    
    /**
     * Get post statistics
     * 
     * @return \Illuminate\Http\Response
     */
    public function postStats()
    {
        $stats = $this->contentService->getPostStats();
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
    
    /**
     * Get category statistics
     * 
     * @return \Illuminate\Http\Response
     */
    public function categoryStats()
    {
        $stats = $this->contentService->getCategoryStats();
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
    
    /**
     * Get tag statistics
     * 
     * @return \Illuminate\Http\Response
     */
    public function tagStats()
    {
        $stats = $this->contentService->getTagStats();
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
    
    /**
     * Get all content statistics
     * 
     * @return \Illuminate\Http\Response
     */
    public function allStats()
    {
        $postStats = $this->contentService->getPostStats();
        $categoryStats = $this->contentService->getCategoryStats();
        $tagStats = $this->contentService->getTagStats();
        
        return response()->json([
            'success' => true,
            'data' => [
                'posts' => $postStats,
                'categories' => $categoryStats,
                'tags' => $tagStats
            ]
        ]);
    }
    
    /**
     * Increment view count for a post
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function incrementViews(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer|exists:posts,id'
        ]);
        
        $result = $this->contentService->incrementPostViews($request->post_id);
        
        return response()->json([
            'success' => $result,
            'message' => $result ? 'View count incremented successfully' : 'Failed to increment view count'
        ]);
    }
    
    /**
     * Clear content cache
     * 
     * @return \Illuminate\Http\Response
     */
    public function clearCache()
    {
        $this->contentService->clearContentCache();
        
        return response()->json([
            'success' => true,
            'message' => 'Content cache cleared successfully'
        ]);
    }
} 