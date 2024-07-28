<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as Session;
use App\Models\Products as Products;
use PhpParser\Node\Expr\Print_;
use Psy\Readline\Hoa\Console;

use function Laravel\Prompts\alert;

class CartController extends Controller
{
    //
    public function viewcart()
    {
        return view('cart');
    }

    public function buyNow(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity');
        $size = $request->input('size');
        $cartKey = $id . '_' . $size;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price_sale ?? $product->price,
                'quantity' => $quantity,
                'size' => $size,
                'image' => $product->image
            ];
        }
        Session::put('cart', $cart);
        return redirect()->route('viewcart')->with('success', 'Product added to cart.');
    }


    public function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $productId = $request->input('id');
            $size = trim($request->input('size'));
            $quantity = (int)$request->input('quantity');
            $product = Products::find($productId);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found.']);
            }

            // Lấy giỏ hàng từ session
            $cart = Session::get('cart', []);

            // Tạo một khóa duy nhất cho sản phẩm dựa trên id và size
            $cartKey = $productId . '_' . $size;

            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $quantity;
            } else {
                // Nếu sản phẩm với kích thước này chưa tồn tại, thêm mới vào giỏ hàng
                $cart[$cartKey] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price_sale ?? $product->price,
                    'quantity' => $quantity,
                    'size' => $size,
                    'image' => $product->image
                ];
            }

            // Lưu giỏ hàng vào session
            Session::put('cart', $cart);

            $totalQuantity = array_sum(array_column($cart, 'quantity'));
            return response()->json([
                'success' => true, 'message' => 'Product added to cart.',
                'totalQuantity' => $totalQuantity
            ]);
        } else {
            alert('Thất bại');
        }
    }
    public function cartRemove(Request $request)
    {
        $id_size = $request->input('id_size');
        $cart = $request->session()->get('cart', []);
        // dd($id_size,$cart);
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (array_key_exists($id_size, $cart)) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$id_size]);

            // Cập nhật giỏ hàng trong session
            $request->session()->put('cart', $cart);

            // Redirect hoặc trả về thông báo thành công
            return redirect()->back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
        } else {
            // Redirect hoặc trả về thông báo lỗi nếu sản phẩm không tồn tại trong giỏ hàng
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
        }
    }
}
