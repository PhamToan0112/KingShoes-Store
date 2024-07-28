<?php

namespace App\Http\Controllers;

use App\Exports\BillsExport;
use Illuminate\Http\Request;
use App\Models\Bills as Bills;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Carts as Carts;

class A_BillsController extends Controller
{   
    public function export() 
    {
        return Excel::download(new BillsExport, 'Bills.xlsx');
    }
    public function view_bills()
    {
        $A_Bills = Bills::BillAll()->paginate(10);
        // dd($A_Bills);
        return view('admin.A_Bills', compact('A_Bills'));
    }

    public function editbill($id)
    {
        $bill = Bills::findOrFail($id);
        return view('admin.A_EditBill', compact('bill'));
    }

    public function updatebill(Request $request, $id)
    {
        $bill = Bills::findOrFail($id);

        $request->validate([
            'status' => 'required|in:dxl,xn,ctt',
        ]);

        $bill->status = $request->status;
        $bill->save();

        return redirect()->route('A_Bills')->with('success', 'Bill updated successfully');
    }

    public function destroy_bill($id){
        $bill = Bills::findOrFail($id);
        $bill->delete();

        return redirect()->route('A_Bills')->with('success', 'Bill deleted successfully!');
    }
    public function detailbill(Request $request){
        $idbill = $request->id;
        $bill = Bills::findOrFail($idbill);
        $cart = Carts::where('idbill',$idbill)->get();
        return view('admin.A_BillDetail', compact('bill', 'cart'));    }
}
