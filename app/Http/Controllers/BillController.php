<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\Carts;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;

class BillController extends Controller
{
    //
    public function viewBill()
    {
        $cart = Session::get('cart', []);
        // dd($cart);
        return view('bill', compact('cart'));
    }
    public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {
            $name_cus = $request->input('name_cus');
            $sdt_cus = $request->input('sdt_cus');
            $email_cus = $request->input('email_cus');
            $diachi_cus = $request->input('diachi_cus');
            $description = $request->input('description');
            $payment_method = $request->input('payment_method');

            $cart = Session::get('cart', []);
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            $sub_total = $total;

            $order_code = 'PTT' . strtoupper(Str::random(10));

            // Lưu vào bảng bill
            $bill = new Bills();
            $bill->order_code = $order_code;
            $bill->user_id = auth()->id();
            $bill->name_cus = $name_cus;
            $bill->email_cus = $email_cus;
            $bill->sdt_cus = $sdt_cus;
            $bill->diachi_cus = $diachi_cus;
            $bill->description = $description;
            $bill->total = $total;
            $bill->sub_total = $sub_total;
            $bill->payment_method = $payment_method;
            $bill->status = 'dxl';
            $bill->save();

            foreach ($cart as $item) {
                $cartItem = new Carts();
                $cartItem->name = $item['name'];
                $cartItem->price = $item['price'];
                $cartItem->image = $item['image'];
                $cartItem->size = $item['size'];
                $cartItem->quantity = $item['quantity'];
                $cartItem->idsp = $item['id'];
                $cartItem->idbill = $bill->id;
                $cartItem->save();
            }

            // Gửi email thông tin đơn hàng
            Mail::to($email_cus)->send(new OrderPlaced($bill, $cart));
            DB::commit();

            Session::forget('cart');

            return redirect()->route('thank_you');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình đặt hàng. Vui lòng thử lại.');
        }
    }

    public function thank_you()
    {
        return view('thanks');
    }
}
