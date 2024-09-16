<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
    {{-- <div class="avatar"><img src="{{ asset('uploads/avatar.jpg')}}" alt="..." class="img-fluid rounded-circle"></div> --}}
    <div class="title">
        <h1 class="h5">{{ Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name }}</h1>
        <p>Admin</p>
    </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="active"><a href="{{ route('admin') }}"> <i class="icon-home"></i>Home</a></li>
        <li class=""><a href="{{ route('admin.user') }}"> <i class="icon-user"></i>Users</a></li>

        <li>
            <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i>
                Categories 
            </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="{{ route('admin.category') }}">List all</a></li>
                <li><a href="{{ route('admin.category.create') }}">Add new</a></li>
            </ul>
        </li>
        <li>
            <a href="#productDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i> Products 
            </a>
            <ul id="productDropdown" class="collapse list-unstyled ">
                <li><a href="{{ route('admin.product') }}">List all</a></li>
                <li><a href="{{ route('admin.product.create') }}">Add new</a></li>
            </ul>
        </li>

        <li>
            <a href="#orderDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i> Orders 
            </a>
            <ul id="orderDropdown" class="collapse list-unstyled ">
                <li><a href="{{ route('admin.order') }}">List all</a></li>
                {{-- <li><a href="{{ route('admin.order.create') }}">Add new</a></li> --}}
            </ul>
        </li>
    </ul>
</nav>