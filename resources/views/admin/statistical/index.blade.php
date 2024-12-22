@extends('admin.layouts._masterLayout')

@section('content')
<div class="container-fluid">
    <div class="block">
        <div class="title"><h2>Thống kê tình hình bán hàng</h2></div>
        <a href="{{ route('admin.statistical.export') }}" class="btn btn-primary text-black">Xuất Excel</a>
        <div class="table-responsive d-flex align-items-start"> 
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Ngày/Tháng</th>
                    <th>Doanh số</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($revenues as $index => $revenue)
                    <tr>
                    <td scope="row">{{ $index + 1  }}</td>
                    <td>{{ $revenue->day }}</td>
                    <td>{{ $revenue->sum_amount }}</td>
                    
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table class="table table-striped table-hover ml-2">
                <thead>
                    <tr>
                    <th>STT</th>
                    <th>Trạng thái</th>
                    <th>Số lượng đơn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordersByStatus as $index => $order)
                    <tr>
                        <td scope="row">{{ $index + 1  }}</td>
                        <td>
                            @if ($order->status == 0)
                                PENDING
                            @elseif($order->status == 1)
                                COMPLETED
                            @else
                                CANCEL
                            @endif
                        </td>
                        <td>{{ $order->total_order }}</td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>

            <table class="table table-striped table-hover ml-2" >
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Khách hàng</th>
                        <th>SL</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordersByUser as $index => $order)
                        <tr>
                            <td scope="row">{{ $index + 1  }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->total_order }} đơn</td>
                            <td>{{ $order->total_amount }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
        
        <div class="block">
            <canvas id="ordersPieChart" width="400" height="400" style="max-width: 400px; max-height: 400px; margin: 0 auto"></canvas>
        </div>

    </div>
</div>

    
@endsection

@section('scripts')
<script>
    // Lấy dữ liệu từ PHP
    const labels = @json($ordersByStatus->pluck('status'));
    const data = @json($ordersByStatus->pluck('total_order'));
    const canvas = document.getElementById('ordersPieChart')
    // Khởi tạo biểu đồ Pie Chart
    const ctx = document.getElementById('ordersPieChart').getContext('2d');
    const ordersPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['PENDING', 'COMPLETED', 'CANCEL'], // Các trạng thái
            datasets: [{
                label: 'Số lượng đơn theo trạng thái',
                data: data, // Số lượng đơn hàng
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw}`;
                        }
                    }
                }
            }
        }
    });

  
</script>
@endsection