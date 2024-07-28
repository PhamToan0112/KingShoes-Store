<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Bills;

class BillsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Bills::all(["order_code","name_cus","sdt_cus","diachi_cus","sub_total","voucher","payment_method"]);
    }
    public function headings(): array{
        return[
            "Mã đơn hàng",
            "Tên KH",
            "Số điện thoại",
            "Địa chỉ",
            "Tổng tiền",
            "Phí vận chuyển",
            "Voucher",
            "Phương thức thanh toán"
        ];
    }
}
