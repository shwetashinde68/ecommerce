<!DOCTYPE html>
<html>

<head>
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">

    <div class="container">
        <h2>All Products</h2>

        @if ($products->isEmpty())
        <p>No products available.</p>
        @else
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Price: ₹{{ $product->price }}</p>
                        <div class="gallery">
                            @foreach ($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_url) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 150px; margin-right: 5px;">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
        @endif
    </div>

</body>

</html>