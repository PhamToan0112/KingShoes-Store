<?php

namespace App\Http\Controllers;
use App\Models\Banners as Banners;
use Illuminate\Http\Request;

class A_BannerController extends Controller
{
    //
    public function view_banners(){
        $A_Banner = Banners::Banner()->paginate(10);
        return view('admin.A_Banner',compact('A_Banner'));
    }
    public function view_addbanner(){
        return view('admin.A_AddBanner');
    }

    public function add_banner(Request $request){
        $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string',
            'sort_order'=>'nullable|integer',
            'status'=>'required|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image_name = null;
        if($request->hasFile('image')) {
            $image_name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/banner'), $image_name);
        }
        Banners::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'sort_order'=> $request->sort_order,
            'status'=> $request->status,
            'image'=> $image_name,
        ]);
        // var_dump($request);
        return redirect()->route('view_addbanner')->with('success','Banners added successfully.');
    }

    public function edit_banner($id){
        $banner = Banners::findOrFail($id);
        return view('admin.A_Editbanner',compact('banner'));
    }
    public function update_banner(Request $request , $id){
        $banner = Banners::findOrFail($id);
        $request->validate([
            "name"=> "required|string",
            "sort_order"=>"nullable|numeric",
            "description"=>"nullable|string",
            "status"=>"required|string",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->name != $banner->name && Banners::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors([
                'name' => 'Name already exists in the database.',
            ])->withInput();
        }
        $imageName = $banner->image;
        if($request->hasFile('image')){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/banner'), $imageName);
    
            // Delete old image if exists
            if ($banner->image) {
                $oldImagePath = public_path('img/banner/' . $banner->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        $banner->update([
            "name"=> $request->name,
            "sort_order"=> $request->sort_order,
            "description"=> $request->description,
            "status"=> $request->status,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.A_Banner')->with('success','Banner Updated successfully');
    }
    public function destroy_banner($id){
        $banner = Banners::findOrFail($id);

        // Xóa file hình ảnh nếu tồn tại
        if ($banner->image) {
            $oldImagePath = public_path('img/banner/' . $banner->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $banner->delete();

        return redirect()->route('admin.A_Banner')->with('success', 'Banners deleted successfully!');
    }
}
