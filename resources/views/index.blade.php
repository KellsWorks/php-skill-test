@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2>Create Product</h2>
    <form id="productForm">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of product" required>
        </div>
        <div class="form-group mt-2">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" required>
        </div>
        <div class="form-group mt-2 mb-2">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<div class="container my-5">
    <h2>Product List</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @if($products && $products->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">No products available</p>
    @endif
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productForm').on('submit', function(event) {
            event.preventDefault();
            let formData = {
                name: $('#name').val(),
                quantity: $('#quantity').val(),
                price: $('#price').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '/products',
                method: 'POST',
                data: formData,
                success: function(data) {
                    $('#productForm')[0].reset();
                    alert('Product created successfully!');
                    setTimeout(() => {
                        location.reload();
                    }, 1000)
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
@endsection