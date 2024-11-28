<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\General;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Category';
        $general = General::first();
        $category = Category::latest();
        if(request()->search){
            $search     = request()->search;
            $category = $category->where('name', 'LIKE',"%$search%");
        }
        $category = $category->paginate($general->paginate);
        return view('admin.category.index', $data, compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
    
        try {
            $slugExist = Category::where('slug', Str::slug($request->name, '-'))->count();
            if($slugExist > 0){
                return back()->with('alert', __('Category name already exists.'));
            }
    
            $iconPath = uploadImage($request->file('icon'), 'images/icon', null, null);
    
            Category::create([
                'name' => $request->name,
                'icon' => $iconPath ?? null, // Salva o caminho da imagem no banco
                'slug' => Str::slug($request->name, '-'),
                'status' => 1
            ]);
    
            return back()->with('success', __('Create Successfully'));  
        } catch (\Exception $e) {
            return back()->with('alert', $e->getMessage());
        }
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => 'required',
            'status' => 'required'
        ]);
        try {
            $category = Category::find($id);
            $slugExist = Category::where('id','!=',$category->id)->where('slug', trim($request->name))->count();
            if($slugExist > 0){
                return back()->with('alert', __('Category name already exist.'));
            }

            if ($request->file('icon')) {
                @unlink('public/images/icon/' . $request->icon);
                $iconPath = uploadImage($request->file('icon'), 'images/icon', null, null);
            } else {
                $iconPath = $request->name;
            }

            $category->update([
                'name' => $request->name,
                'icon' => $iconPath,
                'slug' => Str::slug($request['name'], '-'),
                'status' => $request->status
            ]);
            return back()->with('success', __('Update Successfully'));
        } catch (\Exception $e) {
            return back()->with('alert', $e->getMessage());
        }
    }

}
