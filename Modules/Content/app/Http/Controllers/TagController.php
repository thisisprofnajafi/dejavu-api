<?php

namespace Modules\Content\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Content\app\Http\Requests\StoreTagRequest;
use Modules\Content\app\Http\Requests\UpdateTagRequest;
use Modules\Content\app\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', config('content.pagination.per_page', 10));
        $search = $request->input('search');
        
        $query = Tag::query();
        
        // Filter by search term if provided
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        
        $tags = $query->orderBy('name')->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Content\app\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Tag created successfully',
            'data' => $tag
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Content\app\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return response()->json([
            'success' => true,
            'data' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Content\app\Http\Requests\UpdateTagRequest  $request
     * @param  \Modules\Content\app\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully',
            'data' => $tag
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Content\app\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        // Check if tag is used by any posts
        if ($tag->posts()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete tag that is used by posts. Please remove tag from all posts first.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $tag->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Tag deleted successfully'
        ]);
    }
} 