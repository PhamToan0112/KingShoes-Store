<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Comments;

class ProductController extends Controller
{
    public function index(Request $request, $name_url = null)
    {
        $category = Categories::where('name_cate_Url', $name_url)->first();
        $products_byCate = null;
        $productAll = null;
        $cate_name = null;
        
        if ($category) {
            $cate_id = $category->id;
            $products_byCate = Products::where('category_id', $cate_id)->paginate(8);
            $cate_name = $category->name;
        } else {
            $productAll = Products::paginate(8);
        }

        return view('product', compact('products_byCate', 'productAll', 'cate_name', 'category'));
    }
    public function product_detail(Request $request, $slug)
    {
        $product_detail = Products::where('slug', $slug)->firstOrFail();
        $related_products = Products::RelatedProduct($product_detail)->get();
        return view('product_detail', compact('product_detail', 'related_products'));
    }

    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comments = Comments::where('comment_product_id', $product_id)->paginate(5);

        $out_put = "";
        foreach ($comments as $comm) {
            $out_put .= '
                <div class="comt-content">
                    <div class="m">
                        <div class="d-flex gap-3 p-3 bg-cmt">
                            <img src="' . url('./img/sp/hinh2.jpeg') . '" alt="" style="max-height: 80px; background-position: center">
                            <div class="info-user-comt">
                                <div class="d-flex gap-1">
                                    <p class="textPrice mb-2">' . ucwords($comm->comment_name) . '</p>
                                    <span>|</span>
                                    <p class="mb-2"><strong>2020-12-2 08:00</strong></p>
                                </div>
                                <p class="noidung">' . $comm->comment_content . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        return response()->json([
            'comments' => $out_put,
            'next_page_url' => $comments->nextPageUrl()
        ]);
    }

    public function send_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;

        $comment = Comments::create([
            'comment_product_id' => $product_id,
            'comment_name' => $comment_name,
            'comment_content' => $comment_content,
        ]);

        return response()->json(['success' => 'Comment added successfully', 'comment' => $comment]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');

        // Tìm danh mục theo tên
        $categories = Categories::where('id', 'like', "%$keyword%")->get();
        $categoryIds = $categories->pluck('id')->toArray();

        // Tìm các sản phẩm theo tên sản phẩm hoặc thuộc danh mục có tên trùng khớp
        $products = Products::with('category')
            ->where('name', 'like', "%$keyword%")
            ->orWhereIn('category_id', $categoryIds)
            ->paginate(4);

        return view('search', compact('products', 'keyword', 'categories'));
    }
}
