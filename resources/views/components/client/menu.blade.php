<nav class="main-nav">
    <ul class="menu sf-arrows">
        <li class="active">
            <a href="{{ route('home') }}" class="">Home</a>
        </li>
        @foreach ($categories as $category)
            <li class="">
                <a href="{{ route('home.category', $category->id) }}" class="">{{ $category->name }}</a>
            </li>
        @endforeach
     
    </ul><!-- End .menu -->
</nav><!-- End .main-nav -->