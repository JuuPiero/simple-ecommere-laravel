@extends('client.layout._masterLayout')

@section('content')
<main class="main">
    {{-- <div class="page-header text-center" style="background-image: url('{{ asset('uploads/' . $category->image) }}')">
        <div class="container">
            <h1 class="page-title">{{ $category->name }}<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header --> --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Search</a></li>
                {{-- <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li> --}}
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="products mb-3">
                        <div class="row justify-content-center">
                            @foreach ($products as $product)
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <a href="{{ route('home.product.detail', $product->id) }}">
                                                <img src="{{ asset('uploads/' . $product->images[0]->name) }}" class="product-image">
                                            </a>
                                            <div class="product-action">
                                                <a href="{{ route('cart.add', $product->id) }}" class="btn-product btn-cart"><span>add to cart</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a href="#">{{ $product->category->name }}</a>
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a href="product.html">{{ $product->name }}</a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                                {{ $product->price }}đ
                                            </div><!-- End .product-price -->

                                            <div class="product-nav product-nav-thumbs">
                                                @foreach ($product->images as $image)
                                                    <a href="#" class="active">
                                                        <img src="{{ asset('uploads/' . $image->name ) }}" alt="product desc">
                                                    </a>
                                                @endforeach
                                                {{-- <a href="#" class="active">
                                                    <img src="assets/images/products/product-4-thumb.jpg" alt="product desc">
                                                </a>
                                                <a href="#">
                                                    <img src="assets/images/products/product-4-2-thumb.jpg" alt="product desc">
                                                </a>
                                                <a href="#">
                                                    <img src="assets/images/products/product-4-3-thumb.jpg" alt="product desc">
                                                </a> --}}
                                            </div><!-- End .product-nav -->
                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                            @endforeach
                        </div><!-- End .row -->
                    </div><!-- End .products -->


                    {{-- <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item-total">of 6</li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav> --}}
                </div><!-- End .col-lg-9 -->
             
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
@section('scripts')
@if (session('message'))
<script>
    alert('{{ session('message') }}')
</script>     
@endif
@endsection

