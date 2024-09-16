@extends('admin.layouts._masterLayout')

@section('content')
<div class="container-fluid">
    <div class="block">
        <div class="title"><strong>Order-{{ $order->id }}</strong></div>
        <p><strong>User order : </strong> {{  $order->user->email . ' - ' . $order->user->first_name . ' ' . $order->user->last_name}}</p>
        <p><strong>Receiver Name : </strong> {{ $order->first_name . ' ' . $order->last_name }}</p>
        <p><strong>Phone Number : </strong> {{ $order->phone_number }}</p>
        <strong>Address :</strong>
        <p>{{ $order->address }}</p>
        <strong>Note:</strong>
        <p>{{ $order->note }}</p>
        <h3>Total Amount</h3>
        <p><strong>{{ $order->total_amount }}</strong>$</p>
        <div class="title"><strong>Order Items</strong></div>
        <div class="table-responsive"> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}$</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
     
    </div>
    <div class="block">
        <form
            style="margin-top: 20px"
            class="form-horizontal" method="POST" action="{{ route('admin.order.handle', $order->id) }}" >
            @csrf
            <div class="line"></div>
            @if($order->status)
                <div class="form-group row">
                    <h3 class="col-sm-3 form-control-label">Status</h3>
                    <div class="col-sm-3">
                        <input value="COMPLETE" disabled readonly type="text" class="form-control is-valid">
                    </div>
                </div>
            @else
                <div class="form-group row">
                    <h3 class="col-sm-3 form-control-label">Status</h3>
                    <div class="col-sm-3">
                        <select name="status" class="form-control is-invalid">
                            <option value="0">PENDING</option>
                            <option value="1">COMPLETE</option>
                        </select>
                    </div>
                </div>
                <div class="line"></div>
                <div class="form-group row">
                    <div class="col-sm-9 ml-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>  


@endsection