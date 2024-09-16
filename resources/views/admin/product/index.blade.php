@extends('admin.layouts._masterLayout')

@section('content')
<div class="container-fluid">
    <div class="block">
        <div class="title"><strong>Products</strong></div>
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary text-black">Add new</a>
        <div class="table-responsive"> 
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Category</th>

                <th>Price</th>
                <th>Is Active</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                  <th scope="row">{{ $product->id }}</th>
                  <td>{{ $product->name }}</td>
                  <td><img style="width: 80px; height: 40px; object-fit: cover" src="{{ asset('uploads/' . $product->images[0]->name) }}" alt="" srcset=""></td>
                  <td>{{ $product->category->name }}</td>
                  <td>{{ $product->price}}</td>
                  <td>{{ $product->is_active ? 'true' : 'false'}}</td>
                  <td>
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary text-black">Edit</a>
                    <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-secondary text-black delete-btn">Delete</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>

    
@endsection

@section('scripts')
<script>
  $('.delete-btn').click(e => {
    if(confirm("Bạn có chắc muốn xóa ?")) {
      return true
    }
    else {
      e.preventDefault()
    }
  })
</script>
@endsection