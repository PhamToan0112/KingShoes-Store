<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Categories;
use App\Models\Products;

class A_ProductController extends Controller
{
    public function index()
    {
        $A_products = Products::A_products()->with('category')->paginate(10);
        return view('admin.A_Products', compact('A_products'));
    }

    public function view_addproduct(Request $request)
    {   
        $category = Categories::A_Categories()->get();
        return view('admin.A_AddProduct', compact('category'));
    }

    public function add_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'description' => 'nullable',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img/sp'), $imageName);
        if ($request->slug && Products::where('slug',$request->slug)->exists()) {
            return redirect()->back()->withErrors([
                'slug'=>'Slug exists in database'
            ])->withInput();
        }   
        if($request->name && Products::where('name',$request->name)->exists()){
            return redirect()->back()->withErrors([
                'name'=>'Nam Products exists in database'
            ])->withInput();
        };
        Products::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imageName,
        ]);

        return redirect()->route('view_addproduct')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $category = Categories::A_Categories()->get();
        return view('admin.A_EditProduct', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name','slug', 'description', 'price', 'price_sale', 'quantity' , 'stock', 'category_id' ,'image']);
        
        // Upload hình ảnh mới nếu có
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/sp'), $imageName);
            $data['image'] = $imageName;

            if ($product->image) {
                $oldImagePath = public_path('img/sp/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        $product->update($data);

        return redirect()->route('A_Products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        if ($product->image) {
            $oldImagePath = public_path('img/sp/' . $product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $product->delete();

        return redirect()->route('A_Products')->with('success', 'Product deleted successfully!');
    }
}
