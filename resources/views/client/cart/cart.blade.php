@extends('client.layout._layout')

@section('content')
<main class="main">
    <style>
        .input-group-prepend,
        .input-group-append {
            display: none;
        }
    </style>
    <div class="page-header text-center" style="background-image: url('{{asset('assets/client/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="{{ asset('uploads/' . $item['product']->images[0]->name) }}" alt="Product image">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="#">{{ $item['product']->name }}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">{{ ($item['product']->price) }}$</td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input disabled type="number" class="form-control" value="{{ $item['quantity'] }}" min="1" max="10" step="1" data-decimals="0" required>
                                            </div><!-- End .cart-product-quantity -->
                                        </td>
                                        <td class="total-col">{{ ($item['product']->price * $item['quantity']) }}$</td>
                                        <td class="remove-col"><a href="{{ route('cart.remove', $item['product']->id) }}" class="btn-remove"><i class="icon-close"></i></a></td>
                                    </tr>
                                @endforeach
                     
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td class="total">$160.00</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                            @if (Auth::user())
                                @if (count($items) <= 0)
                                    <button class="btn btn-outline-primary-2 btn-order btn-block">Your cart is empty</button>
                                @else
                                    <a href="{{ route('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                @endif
                            @else
                                <a href="{{ route('user.login') }}" class="btn btn-outline-primary-2 btn-order btn-block">You need to login</a>
                            @endif
                           
                        </div><!-- End .summary -->

                        <a href="{{ route('home') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
@section('scripts')
<script>
    const totalCols = document.querySelectorAll('.total-col')
    let total = 0
    totalCols.forEach(item => {
        total += Number.parseFloat(item.innerText.substring(-1))
    })
    document.querySelector('.total').innerText = total + '$'

</script>
@endsection
