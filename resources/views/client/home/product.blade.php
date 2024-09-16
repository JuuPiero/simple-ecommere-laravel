@extends('client.layout._masterLayout')

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Default</li>
            </ol>

        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{ asset('uploads/' . $product->images[0]->name) }}" data-zoom-image="{{ asset('uploads/' . $product->images[0]->name) }}" alt="product image">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @foreach ($product->images as $image)
                                        <a class="product-gallery-item active" href="#" data-image="{{ asset('uploads/' . $image->name) }}" data-zoom-image="{{ asset('uploads/' . $image->name) }}">
                                            <img src="{{ asset('uploads/' . $image->name) }}" alt="{{$image->name}}">
                                        </a>
                                    @endforeach
                                 
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                            <div class="product-price">
                                {{  $product->price }} đ
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>{{ $product->description }}</p>
                            </div><!-- End .product-content -->


                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" disabled id="qty" class="form-control" value="1"  data-decimals="0" readonly>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action">
                                <a href="{{ route('cart.add', $product->id) }}" class="btn-product btn-cart"><span>add to cart</span></a>

                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                              
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                  
                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Product Information</h3>
                            <p>{{ $product->description }}</p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
               @foreach ($suggests as $item)
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="{{ route('home.product.detail', $item->id) }}">
                            <img src="{{ asset('uploads/' . $item->images[0]->name) }}" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action">
                            <a href="{{ route('cart.add', $item->id) }}" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">{{ $item->category->name }}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">{{ $item->name }}</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            {{ '$' . $item->price }}
                        </div><!-- End .product-price -->
                    
                        <div class="product-nav product-nav-thumbs">
                            @foreach ($item->images as $image)
                                <a href="#" class="active">
                                    <img src="{{ asset('uploads/' . $image->name) }}" alt="product desc">
                                </a>
                            @endforeach
                           
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
               @endforeach

                

                
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->    

@endsection