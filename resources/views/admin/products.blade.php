<h2>Product List</h2>
@foreach ($products as $product)
    <div>
        <h4>{{ $product->name }} (₹{{ $product->price }})</h4>
        @foreach ($product->images as $img)
            <img src="{{ asset('storage/' . $img->image_url) }}" width="100">
        @endforeach
    </div>
@endforeach
