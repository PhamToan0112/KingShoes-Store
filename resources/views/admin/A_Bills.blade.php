@extends('admin.layout_admin')
@section('title', 'Trang bills')
@section('content_ad')
    <div class="container-fluid" style="max-height: 730px; overflow-y: auto;">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Lists Bills</h1>
        <p class="mb-4">Trang quản lí danh sách đơn hàng <a target="_blank" href="https://datatables.net">Thuộc quyền sở
                hữu
                của PTT_FPT</a>.
        </p>
        <div class="form-group">
            <a href="{{ route('exportBill') }}">
                <button type="button" class="btn bg-primary" style="color:azure">
                    Xuất Excel
                </button>
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @php
            $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
            $filteredBills = [];
            foreach ($A_Bills as $bill) {
                if ($statusFilter == '') {
                    $filteredBills[] = $bill;
                } elseif ($bill->status == $statusFilter) {
                    $filteredBills[] = $bill;
                }
            }

        @endphp
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex ">
                <h6 class="m-0 col-lg-8 font-weight-bold text-primary">DataTables Example</h6>
                <div class="input-group col-lg-4 right-0 end-0">
                    <input type="search" placeholder="search here.." class="form-control" id="basic-url"
                        aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="css-th-content">
                                <th>STT</th>
                                <th>Func</th>
                                <th>
                                    <select name="status" id="status-filter">
                                        <option value="">Tất cả</option>
                                        <option value="xn" {{ $statusFilter == 'xn' ? 'selected' : '' }}>Xác nhận</option>
                                        <option value="dxl" {{ $statusFilter == 'dxl' ? 'selected' : '' }}>Đang xử lí</option>
                                    </select>                                    
                                </th>
                                <th>Order_Code</th>
                                <th>User_id</th>
                                <th>Name_cus</th>
                                <th>Email_cus</th>
                                <th>Phone_cus</th>
                                <th>Address_cus</th>
                                <th>Description</th>
                                <th>Sub_total</th>
                                <th>Ship</th>
                                <th>Voucher</th>
                                <th>Total</th>
                                <th>Payment_method</th>

                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Export <i class="fas fa-print"></i></th>

                            </tr>
                        </thead>
                        <tfoot>
                            <th>STT</th>
                            <th>Func</th>
                            <th>Status</th>
                            <th>Order_Code</th>
                            <th>User_id</th>
                            <th>Name_cus</th>
                            <th>Email_cus</th>
                            <th>Phone_cus</th>
                            <th>Address_cus</th>
                            <th>Description</th>
                            <th>Sub_total</th>
                            <th>Ship</th>
                            <th>Voucher</th>
                            <th>Total</th>
                            <th>Payment_method</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Export <i class="fas fa-print"></i></th>
                        </tfoot>
                        <tbody>
                            @foreach ($filteredBills as $item)
                                <tr class="css-td-content">
                                    <td>{{ $item->id }}</td>
                                    <td class="text-center d-flex " style="gap:3px">
                                        <form action="{{ route('update.bill', $item->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="xn">
                                            <button type="submit" class="badge p-2 text-bg-primary"><i
                                                    class="fas fa-edit"></i> Xác nhận</button>
                                        </form>
                                        <form action="{{ route('detail.bill', $item->id) }}" method="get"
                                            style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="badge p-2 text-bg-danger"> Chi tiết</button>
                                        </form>
                                        @if ($item->status=='xn')
                                        <form action="{{ route('delete.bill', $item->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge p-2 text-bg-danger"> Xóa đơn</button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'dxl')
                                            <span style="color:red">Chờ xác nhận</span>
                                        @elseif($item->status == 'xn')
                                            <span style="color: rgb(0, 85, 255">Xác nhận</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->order_code }}</td>
                                    <td>{{ $item->user_id }}</td>
                                    <td>{{ $item->name_cus }}</td>
                                    <td>{{ $item->email_cus }}</td>
                                    <td>{{ $item->sdt_cus }}</td>
                                    <td>{{ $item->diachi_cus }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ number_format($item->sub_total) }}</td>
                                    <td>{{ number_format($item->ship) }}</td>
                                    <td>{{ number_format($item->voucher) }}</td>
                                    <td>{{ number_format($item->total) }}</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <form action="" method="post" class="func">
                                                @csrf
                                                <button type="submit" class="badge p-2 text-bg-secondary" disabled>Xuất
                                                    đơn</button>
                                            </form>
                                        @else
                                            <form action="" method="post" class="func">
                                                @csrf
                                                <button type="submit" class="badge p-2 text-bg-primary">Xuất
                                                    đơn</button>
                                            </form>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $A_Bills->links('vendor.pagination.custom') }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('status-filter').addEventListener('change', function() {
            var selectedStatus = this.value;
            window.location.href = window.location.pathname + '?status=' + selectedStatus;
        });
    </script>
@endsection
