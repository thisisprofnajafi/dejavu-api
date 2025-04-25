<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\AdminMenu;
use Modules\Admin\Models\AdminActivity;

class AdminMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage menu');
    }

    /**
     * Display a listing of the menus.
     */
    public function index()
    {
        $menus = AdminMenu::with('parent', 'children')
            ->parents()
            ->orderBy('order')
            ->get();
        
        return view('admin::menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create()
    {
        $parentMenus = AdminMenu::parents()->orderBy('order')->get();
        return view('admin::menus.create', compact('parentMenus'));
    }

    /**
     * Store a newly created menu in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:admin_menus,id',
            'route' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'permission' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_visible' => 'boolean',
        ]);
        
        $menu = AdminMenu::create($data);
        
        // Log activity
        AdminActivity::logCreate('menu', $menu->id, $menu->toArray());
        
        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit($id)
    {
        $menu = AdminMenu::findOrFail($id);
        $parentMenus = AdminMenu::parents()->where('id', '!=', $id)->orderBy('order')->get();
        
        return view('admin::menus.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified menu in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = AdminMenu::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:admin_menus,id',
            'route' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'permission' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_visible' => 'boolean',
        ]);
        
        // Prevent menu from being its own parent
        if ($data['parent_id'] == $id) {
            $data['parent_id'] = null;
        }
        
        $beforeData = $menu->toArray();
        $menu->update($data);
        
        // Log activity
        AdminActivity::logUpdate('menu', $menu->id, $beforeData, $menu->toArray());
        
        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified menu from storage.
     */
    public function destroy($id)
    {
        $menu = AdminMenu::findOrFail($id);
        
        // Log activity before deleting
        AdminActivity::logDelete('menu', $menu->id, $menu->toArray());
        
        $menu->delete();
        
        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu deleted successfully.');
    }

    /**
     * Update menu order.
     */
    public function updateOrder(Request $request)
    {
        $menuIds = $request->input('menu_ids', []);
        $parentId = $request->input('parent_id');
        
        foreach ($menuIds as $order => $id) {
            $menu = AdminMenu::find($id);
            if ($menu) {
                $beforeData = $menu->toArray();
                
                $menu->update([
                    'parent_id' => $parentId ?: null,
                    'order' => $order
                ]);
                
                // Log activity
                AdminActivity::logUpdate('menu', $menu->id, $beforeData, $menu->toArray(), 'Menu order updated');
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Menu order updated successfully'
        ]);
    }

    /**
     * Get all menus as JSON for the admin sidebar.
     */
    public function getMenus()
    {
        $user = auth()->user();
        
        $menus = AdminMenu::with('children')
            ->parents()
            ->active()
            ->visible()
            ->orderBy('order')
            ->get()
            ->filter(function ($menu) use ($user) {
                // Filter menus based on user permissions
                return !$menu->permission || $user->can($menu->permission);
            })
            ->map(function ($menu) use ($user) {
                // Also filter children
                if ($menu->children->isNotEmpty()) {
                    $menu->children = $menu->children
                        ->filter(function ($child) use ($user) {
                            return $child->is_active && $child->is_visible && 
                                (!$child->permission || $user->can($child->permission));
                        })
                        ->sortBy('order')
                        ->values();
                }
                return $menu;
            });
        
        return response()->json([
            'success' => true,
            'data' => $menus
        ]);
    }
} 