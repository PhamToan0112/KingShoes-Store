<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories as Categories;
class A_Categories extends Controller
{
    //
    public function view_categories(){
        $A_Categories = Categories::A_Categories()->paginate(10);
        return view('admin.A_Categories',compact('A_Categories'));
    }
    public function view_addcategories(){
        return view('admin.A_AddCategories');
    }
    public function add_categories(Request $request){
        $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string',
            'name_cate_Url'=>'nullable|string',
            'parent_id'=>'nullable|integer',
            'status'=>'required|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image_name = null;
        if($request->hasFile('image')) {
            $image_name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/cate'), $image_name);
        }
        if($request->name_cate_Url && Categories::where('name_cate_Url',$request->name_cate_Url)->exists()){
            return redirect()->back()->withErrors([
                'name'=>'Nam Categories exists in database'
            ])->withInput();
        };
        if($request->name && Categories::where('name',$request->name)->exists()){
            return redirect()->back()->withErrors([
                'name'=>'Nam Categories exists in database'
            ])->withInput();
        }
        Categories::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'name_cate_Url'=> $request->name_cate_Url,
            'parent_id'=> $request->parent_id,
            'status'=> $request->status,
            'image'=> $image_name,
        ]);
        // var_dump($request);
        return redirect()->route('view_addcategories')->with('success','Category added successfully.');
    }

    public function destroy_categories($id){
        $category = Categories::findOrFail($id);

        // Xóa file hình ảnh nếu tồn tại
        if ($category->image) {
            $oldImagePath = public_path('img/cate/' . $category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $category->delete();

        return redirect()->route('A_Categories')->with('success', 'Categories deleted successfully!');
    }
    public function edit_categories($id){
        $category = Categories::findOrFail($id);
        return view('admin.A_EditCategories',compact('category'));
    }

    public function update_categories(Request $request , $id){
        $category = Categories::findOrFail($id);
        $request->validate([
            "name"=> "required|string",
            "name_cate_Url"=>"nullable|string",
            "description"=>"nullable|string",
            "status"=>"required|string",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // if ($request->name && Categories::where('name',$request->name)->exists()) {
        //     return redirect()->back()->withErrors([
        //         'name'=>'Name Category exists in database'
        //     ])->withInput();
        // }

        $imageName = $category->image;
        if($request->hasFile('image')){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/cate'), $imageName);
    
            // Delete old image if exists
            if ($category->image) {
                $oldImagePath = public_path('img/cate/' . $category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        $category->update([
            "name"=> $request->name,
            "name_cate_Url"=> $request->name_cate_Url,
            "description"=> $request->description,
            "status"=> $request->status,
            'image' => $imageName,
        ]);

        return redirect()->route('A_Categories')->with('success','Category Updated successfully');
    }
}
